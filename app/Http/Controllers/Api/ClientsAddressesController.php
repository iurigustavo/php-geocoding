<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\ClientAddress;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    class ClientsAddressesController extends Controller
    {
        public function __invoke(Request $request): JsonResponse
        {
            $result = ['status' => 'success'];
            $query  = ClientAddress::query()->with('client');

            $columns = ['street_address', 'neighborhood', 'zipcode', 'city'];

            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%'.$request->get('q').'%');
            }

            $result['items'] = $query->get();
            $result['total_count'] = $query->count();

            return response()->json($result);

        }
    }
