<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintCreateRequest;
use App\Http\Requests\ComplaintUpdateRequest;
use App\Repositories\ComplaintRepository;
use App\Validators\ComplaintValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ComplaintsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ComplaintsController extends Controller
{
    /**
     * @var ComplaintRepository
     */
    protected $repository;

    /**
     * @var ComplaintValidator
     */
    protected $validator;

    /**
     * ComplaintsController constructor.
     *
     * @param ComplaintRepository $repository
     * @param ComplaintValidator $validator
     */
    public function __construct(ComplaintRepository $repository, ComplaintValidator $validator)
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
        $complaints = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $complaints,
            ]);
        }

        return view('complaints.index', compact('complaints'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ComplaintCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ComplaintCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $complaint = $this->repository->create($request->all());

            $response = [
                'message' => 'Complaint created.',
                'data' => $complaint->toArray(),
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
        $complaint = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $complaint,
            ]);
        }

        return view('complaints.show', compact('complaint'));
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
        $complaint = $this->repository->find($id);

        return view('complaints.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ComplaintUpdateRequest $request
     * @param string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ComplaintUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $complaint = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Complaint updated.',
                'data' => $complaint->toArray(),
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
                'message' => 'Complaint deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Complaint deleted.');
    }
}
