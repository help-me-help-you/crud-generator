<?php

namespace App\Http\Controllers\Admin\Crud;

use App\Http\Requests;
use App\Http\Requests\Crud\CreateCrudRequest;
use App\Http\Requests\Crud\UpdateCrudRequest;
use App\Repositories\Crud\CrudRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Crud\Crud;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CrudController extends InfyOmBaseController
{
    /** @var  CrudRepository */
    private $crudRepository;

    public function __construct(CrudRepository $crudRepo)
    {
        $this->crudRepository = $crudRepo;
    }

    /**
     * Display a listing of the Crud.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->crudRepository->pushCriteria(new RequestCriteria($request));
        $cruds = $this->crudRepository->all();
        return view('admin.crud.cruds.index')
            ->with('cruds', $cruds);
    }

    /**
     * Show the form for creating a new Crud.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.crud.cruds.create');
    }

    /**
     * Store a newly created Crud in storage.
     *
     * @param CreateCrudRequest $request
     *
     * @return Response
     */
    public function store(CreateCrudRequest $request)
    {
        $input = $request->all();

        $crud = $this->crudRepository->create($input);

        Flash::success('Crud saved successfully.');

        return redirect(route('admin.crud.cruds.index'));
    }

    /**
     * Display the specified Crud.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $crud = $this->crudRepository->findWithoutFail($id);

        if (empty($crud)) {
            Flash::error('Crud not found');

            return redirect(route('cruds.index'));
        }

        return view('admin.crud.cruds.show')->with('crud', $crud);
    }

    /**
     * Show the form for editing the specified Crud.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $crud = $this->crudRepository->findWithoutFail($id);

        if (empty($crud)) {
            Flash::error('Crud not found');

            return redirect(route('cruds.index'));
        }

        return view('admin.crud.cruds.edit')->with('crud', $crud);
    }

    /**
     * Update the specified Crud in storage.
     *
     * @param  int              $id
     * @param UpdateCrudRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCrudRequest $request)
    {
        $crud = $this->crudRepository->findWithoutFail($id);

        

        if (empty($crud)) {
            Flash::error('Crud not found');

            return redirect(route('cruds.index'));
        }

        $crud = $this->crudRepository->update($request->all(), $id);

        Flash::success('Crud updated successfully.');

        return redirect(route('admin.crud.cruds.index'));
    }

    /**
     * Remove the specified Crud from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.crud.cruds.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Crud::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.crud.cruds.index'))->with('success', Lang::get('message.success.delete'));

       }

}
