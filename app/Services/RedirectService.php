<?php

namespace App\Services;

use App\Models\Redirect;
use Hashids\Hashids;
use Illuminate\Support\Facades\Http;
use App\Models\RedirectLog;
use Illuminate\Support\Facades\DB;


class RedirectService
{

    public function index()
    {
        $redirects = Redirect::all();

        foreach ($redirects as $redirect) {
            $lastAccess = RedirectLog::where('redirect_id', $redirect->id)
                ->latest('accessed_at')
                ->value('accessed_at');

            $redirect->last_access = $lastAccess ?: null;
            unset($redirect->id);
        }

        return response()->json($redirects, 200);
    }


    public function store($request)
    {
        $hashids = new Hashids();
        $code = $hashids->encode(time());

        $redirect = Redirect::create([
            'url_destino' => $request->url_destino,
            'code' => $code,
        ]);

        return response()->json($redirect, 201);
    }

    public function update($request, $code)
    {
        $redirect = Redirect::where('code', $code)->first();

        if (!$redirect) {
            return response()->json(['message' => 'Redirect not found'], 404);
        }

        if ($request->has('url_destino')) {
            $url_destino = $request->url_destino;

            // Validação da URL de destino
            if (!filter_var($url_destino, FILTER_VALIDATE_URL)) {
                return response()->json(['message' => 'Invalid destination URL'], 400);
            }

            // Verifica se a URL de destino é HTTPS
            if (parse_url($url_destino, PHP_URL_SCHEME) !== 'https') {
                return response()->json(['message' => 'Destination URL must be HTTPS'], 400);
            }

            // Verifica se a URL de destino não aponta para a própria aplicação
            if (parse_url($url_destino, PHP_URL_HOST) === request()->getHost()) {
                return response()->json(['message' => 'Destination URL cannot point to the same application'], 400);
            }

            // Valida se a URL de destino está acessível
            $response = Http::get($url_destino);

            if (!$response->ok()) {
                return response()->json(['message' => 'Destination URL is not accessible'], 400);
            }

            $redirect->url_destino = $url_destino;
        }

        if ($request->has('ativo')) {
            $redirect->ativo = $request->ativo;
        }

        $redirect->save();

        return response()->json([
            'url_destino' => $redirect->url_destino,
            'code' => $redirect->code,
            'ativo' => $redirect->ativo,
            'last_access' => $redirect->last_access,
            'created_at' => $redirect->created_at,
            'updated_at' => $redirect->updated_at,
        ], 200);
    }


    public function destroy($id)
    {
        $redirect = Redirect::where('code', $id)->first();

        if (!$redirect) {
            return response()->json(['message' => 'Redirect not found'], 404);
        }

        $redirect->delete();

        return response()->json(['message' => 'Redirect deleted'], 200);
    }

    public function redirect($code)
    {
        $redirect = Redirect::where('code', $code)
            ->where('ativo', 1)
            ->first();

        if (!$redirect) {
            abort(404);
        }

        // Registro de acesso no RedirectLog
        RedirectLog::create([
            'redirect_id' => $redirect->id,
            'ip' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'referer' => request()->header('Referer'),
            'query_params' => json_encode(request()->query()),
            'accessed_at' => now(),
        ]);

        $urlDestino = $redirect->url_destino;

        // Verifica se há query params na URL de destino
        $queryParams = request()->query();
        if (!empty($queryParams)) {
            $urlParts = parse_url($urlDestino);
            $currentQueryParams = [];
            if (isset($urlParts['query'])) {
                parse_str($urlParts['query'], $currentQueryParams);
            }
            $mergedQueryParams = array_merge($currentQueryParams, $queryParams);
            $urlDestino = $urlParts['scheme'] . '://' . $urlParts['host'] . $urlParts['path'] . '?' . http_build_query($mergedQueryParams);
        }

        return redirect()->to($urlDestino);
    }


    public function getRedirectLogs($code)
    {
        $redirect = Redirect::where('code', $code)->first();

        if (!$redirect) {
            abort(404);
        }

        $logs = RedirectLog::where('redirect_id', $redirect->id)->get();

        return response()->json(['logs' => $logs], 200);
    }

    public function getStats($code)
    {
        $redirect = Redirect::where('code', $code)->first();

        if (!$redirect) {
            abort(404);
        }

        $totalAccesses = RedirectLog::where('redirect_id', $redirect->id)->count();

        $uniqueAccesses = RedirectLog::where('redirect_id', $redirect->id)
            ->distinct('ip')
            ->count('ip');

        $topReferrers = RedirectLog::where('redirect_id', $redirect->id)
            ->select('referer', DB::raw('count(*) as total'))
            ->groupBy('referer')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $dateAccesses = RedirectLog::where('redirect_id', $redirect->id)
            ->select(DB::raw('date(accessed_at) as date'), DB::raw('count(*) as total'), DB::raw('count(distinct ip) as unique_ips'))
            ->groupBy('date')
            ->orderByDesc('date')
            ->limit(10)
            ->get();

        return response()->json([
            'total_accesses' => $totalAccesses,
            'unique_accesses' => $uniqueAccesses,
            'top_referrers' => $topReferrers,
            'date_accesses' => $dateAccesses,
        ], 200);
    }

}
