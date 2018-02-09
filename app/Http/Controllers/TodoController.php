<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * En esta clase deben implementar los metodos vacios de acuerdo a lo
 * previamente estudiado acerca de RESTFul. Recuerda que DEBEN validar los datos
 * de entrada y de regresar lo que les pide el método correctamente.
 *
 * Class TodoController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    /**
     * Este método del controlador regresa el listado del todos de la app
     * en un response del tipo json ordenados desde el más antiguo al más nuevo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // TODO
        $todo = Todo::All();
        return response()->json([
            'data' => $todo,
            'message' => 'Success'
        ], Response::HTTP_OK);
    }

    /**
     * Este método del controlador debe crear un nuevo registro todo
     * y al final regresa el registro creado en un response del tipo
     * json.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // TODO

        $this->validate($request, [
            'text' => 'required|max:255',
        ]);

        $todo = Todo::create([
            'text' => request('text'),
        ]);

        return response()->json([
            'data' => $todo,
            'message' => 'Success'
        ], Response::HTTP_OK);
    }

    /**
     * Modifica el item todo con el $id correspondiente
     * y regresa el mismo item modificado.
     *
     * @param integer $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        // TODO
        $this->validate($request, [
            'text' => 'required|max:255',
        ]);

        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'message' => "Todo {$id} not found"
            ], Response::HTTP_NOT_FOUND);
        }
        $todo->text = request('text');
        $todo->done = request('done');
        $todo->save();

        return response()->json([
            'message' => 'Todo updated successfully!'
        ], Response::HTTP_OK);
    }

    /**
     * Elimina el registro y devuelve un response 200 en caso de exito o un 400
     * en caso de fallo pero igual en tipo json.
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {

        // TODO
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'message' => "Todo {$id} not found"
            ], Response::HTTP_NOT_FOUND);
        }

        $todo->delete();

        return response()->json([
            'message' => 'Todo deleted successfully!'
        ], Response::HTTP_OK);
    }
}
