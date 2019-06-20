<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintItemCreateRequest;
use App\Http\Requests\ComplaintItemUpdateRequest;
use App\Repositories\ComplaintItemRepository;
use App\Validators\ComplaintItemValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ComplaintItemsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ComplaintItemsController extends Controller
{
    /**
     * @var ComplaintItemRepository
     */
    protected $repository;

    /**
     * @var ComplaintItemValidator
     */
    protected $validator;

    /**
     * ComplaintItemsController constructor.
     *
     * @param ComplaintItemRepository $repository
     * @param ComplaintItemValidator $validator
     */
    public function __construct(ComplaintItemRepository $repository, ComplaintItemValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $complaintItems = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $complaintItems,
            ]);
        }

        return view('complaintItems.index', compact('complaintItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ComplaintItemCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ComplaintItemCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $complaintItem = $this->repository->create($request->all());

            $response = [
                'message' => 'ComplaintItem created.',
                'data' => $complaintItem->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complaintItem = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $complaintItem,
            ]);
        }

        return view('complaintItems.show', compact('complaintItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complaintItem = $this->repository->find($id);

        return view('complaintItems.edit', compact('complaintItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ComplaintItemUpdateRequest $request
     * @param string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ComplaintItemUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $complaintItem = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ComplaintItem updated.',
                'data' => $complaintItem->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'ComplaintItem deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ComplaintItem deleted.');
    }
}
