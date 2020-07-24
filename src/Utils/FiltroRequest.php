<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class FiltroRequest
 * @package App\Utils
 */
class FiltroRequest
{
    /**
     * @param Request $request
     * @return array|null
     */
    private function getDadosUrl(Request $request): ?array
    {
        $order = $request->query->get("order");

        $filtros = $request->query->all();
        unset($filtros["order"]);

        return [$order, $filtros];
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function getOrder(Request $request): ?array
    {
        [$order,] = $this->getDadosUrl($request);

        return $order;
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function getFiltros(Request $request): ?array
    {
        [, $filtros] = $this->getDadosUrl($request);

        return $filtros;
    }
}