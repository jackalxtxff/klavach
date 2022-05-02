<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DictionaryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 10;

        // Если запрос от ajax
        if ($request->ajax()) {
            $direction = $request->direction;

            //Раздел "Новые"
            if ($request->chapter == 'new') {
                //Тип все кроме "Любые"
                if($request->type != 0) {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->where('type_id', $request->type)
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->whereHas('report', function ($query) use ($request) {
                            return $query->where('status_code', $request->chapter)
                                ->orWhere('status_code', 'wait');
                        })
                        ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                        ->orderBy('reports.created_at', $direction)
                        ->select('dictionaries.*')
                        ->paginate($paginate);
                }
                //Тип "Любые"
                else {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->whereHas('report', function ($query) use ($request) {
                            return $query->where('status_code', $request->chapter)
                                ->orWhere('status_code', 'wait');
                        })
                        ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                        ->orderBy('reports.created_at', $direction)
                        ->select('dictionaries.*')
                        ->paginate($paginate);
                }
            }
            elseif ($request->chapter == 'accept') {
                if($request->type != 0) {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->where('type_id', $request->type)
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->whereHas('report', function ($query) use ($request) {
                            return $query->where('status_code', $request->chapter);
                        })
                        ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                        ->orderBy('reports.created_at', $direction)
                        ->select('dictionaries.*')
                        ->paginate($paginate);
                }
                else {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->whereHas('report', function ($query) use ($request) {
                            return $query->where('status_code', $request->chapter);
                        })
                        ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                        ->orderBy('reports.created_at', $direction)
                        ->select('dictionaries.*')
                        ->paginate($paginate);
                }
            }
            elseif ($request->chapter == 'deny') {
                if($request->type != 0) {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->where('type_id', $request->type)
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->whereHas('report', function ($query) use ($request) {
                            return $query->where('status_code', $request->chapter);
                        })
                        ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                        ->orderBy('reports.created_at', $direction)
                        ->select('dictionaries.*')
                        ->paginate($paginate);
                }
                else {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->whereHas('report', function ($query) use ($request) {
                            return $query->where('status_code', $request->chapter);
                        })
                        ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                        ->orderBy('reports.created_at', $direction)
                        ->select('dictionaries.*')
                        ->paginate($paginate);
                }
            }

            return response()->json([
                'dictionaries' => $dictionaries,
                'view' => view('admin.pages.dictionaries.ajax.dictionariesSorting', [
                    'dictionaries' => $dictionaries
                ])->render()
            ]);
        }


        $direction = $request->direction;

        // Загрузка страницы без ajax
        $dictionaries = Dictionary::with('user', 'report')
            ->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
            })
            ->join('users', 'dictionaries.user_id', 'users.id')
            ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
            ->whereHas('report', function ($query) use ($request) {
                return $query->where('status_code', 'new')
                    ->orWhere('status_code', 'wait');
            })
            ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
            ->orderBy('reports.created_at', 'desc')
            ->select('dictionaries.*')
            ->paginate($paginate);

        if ($request->chapter == 'new') {
            //Тип все кроме "Любые"
            if($request->type != 0) {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->where('type_id', $request->type)
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->whereHas('report', function ($query) use ($request) {
                        return $query->where('status_code', $request->chapter)
                            ->orWhere('status_code', 'wait');
                    })
                    ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                    ->orderBy('reports.created_at', $direction)
                    ->select('dictionaries.*')
                    ->paginate($paginate);
            }
            //Тип "Любые"
            else {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->whereHas('report', function ($query) use ($request) {
                        return $query->where('status_code', $request->chapter)
                            ->orWhere('status_code', 'wait');
                    })
                    ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                    ->orderBy('reports.created_at', $direction)
                    ->select('dictionaries.*')
                    ->paginate($paginate);
            }
        }
        elseif ($request->chapter == 'accept') {
            if($request->type != 0) {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->where('type_id', $request->type)
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->whereHas('report', function ($query) use ($request) {
                        return $query->where('status_code', $request->chapter);
                    })
                    ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                    ->orderBy('reports.created_at', $direction)
                    ->select('dictionaries.*')
                    ->paginate($paginate);
            }
            else {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->whereHas('report', function ($query) use ($request) {
                        return $query->where('status_code', $request->chapter);
                    })
                    ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                    ->orderBy('reports.created_at', $direction)
                    ->select('dictionaries.*')
                    ->paginate($paginate);
            }
        }
        elseif ($request->chapter == 'deny') {
            if($request->type != 0) {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->where('type_id', $request->type)
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->whereHas('report', function ($query) use ($request) {
                        return $query->where('status_code', $request->chapter);
                    })
                    ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                    ->orderBy('reports.created_at', $direction)
                    ->select('dictionaries.*')
                    ->paginate($paginate);
            }
            else {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->whereHas('report', function ($query) use ($request) {
                        return $query->where('status_code', $request->chapter);
                    })
                    ->join('reports', 'reports.dictionary_id', 'dictionaries.id')
                    ->orderBy('reports.created_at', $direction)
                    ->select('dictionaries.*')
                    ->paginate($paginate);
            }
        }

        return view('admin.pages.dictionaries.dictionaries', [
            'dictionaries' => $dictionaries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function show(Dictionary $dictionary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function edit(Dictionary $dictionary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dictionary $dictionary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dictionary $dictionary)
    {
        //
    }
}
