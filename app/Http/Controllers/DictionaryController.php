<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Dictionary;
use App\Models\Excerpt;
use App\Models\Game;
use App\Models\Grade;
use App\Models\Language;
use App\Models\Report;
use App\Models\Stats;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Jenssegers\Date\Date;

class DictionaryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'], ['except' => ['index', 'show']]);
    }

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
            if ($request->sort == 'popular') {
                $column = 'count_games';
            }
            else if ($request->sort == 'grade') {
                $column = 'avg_grade';
            }
            else if ($request->sort == 'diff') {
                $column = 'avg_speed';
                if ($request->direction == 'asc') {
                    $direction = 'desc';
                }
                else {
                    $direction = 'asc';
                }
            }

            //Раздел "Любые"
            if ($request->chapter == 'all') {
                //Тип все кроме "Любые"
                if($request->type != 0) {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->whereHas('report', function ($query) {
                            return $query->where('status_code', 'accept');
                        })
                        ->where('is_publish', 1)
                        ->where('type_id', $request->type)
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->orderBy('stats.' . $column, $direction)
                        ->paginate($paginate);
                }
                //Тип "Любые"
                else {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->whereHas('report', function ($query) {
                            return $query->where('status_code', 'accept');
                        })
                        ->where('is_publish', 1)
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->orderBy('stats.' . $column, $direction)
                        ->paginate($paginate);
                }
            }
            elseif ($request->chapter == 'my') {
                if($request->type != 0) {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->where('user_id', Auth::id())
                        ->where('type_id', $request->type)
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->orderBy('stats.' . $column, $direction)
                        ->paginate($paginate);
                }
                else {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->where('user_id', Auth::id())
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->orderBy('stats.' . $column, $direction)
                        ->paginate($paginate);
                }
            }
            elseif ($request->chapter == 'favs') {
                if($request->type != 0) {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->whereHas('report', function ($query) {
                            return $query->where('status_code', 'accept');
                        })
                        ->where('type_id', $request->type)
                        ->whereHas('favorites', function ($query) {
                            return $query->where('user_id', Auth::id());
                        })
                        ->where('is_publish', 1)
                        ->where('user_id', '!=', Auth::id())
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->orderBy('stats.' . $column, $direction)
                        ->paginate($paginate);
                }
                else {
                    $dictionaries = Dictionary::with('user', 'stats', 'report')
                        ->with(['favorites' => function ($query) {
                            return $query->where('user_id', Auth::id());
                        }])
                        ->whereHas('report', function ($query) {
                            return $query->where('status_code', 'accept');
                        })
                        ->whereHas('favorites', function ($query) {
                            return $query->where('user_id', Auth::id());
                        })
                        ->where('is_publish', 1)
                        ->where('user_id', '!=', Auth::id())
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                        })
                        ->join('users', 'dictionaries.user_id', 'users.id')
                        ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                        ->orderBy('stats.' . $column, $direction)
                        ->paginate($paginate);
                }
            }

            return response()->json([
                'dictionaries' => $dictionaries,
                'view' => view('user.pages.dictionaries.ajax.dictionariesSorting', [
                    'dictionaries' => $dictionaries
                ])->render()
            ]);
        }

        $direction = $request->direction;
        $column = 'count_games';
        if ($request->sort == 'popular') {
            $column = 'count_games';
        }
        else if ($request->sort == 'grade') {
            $column = 'avg_grade';
        }
        else if ($request->sort == 'diff') {
            $column = 'avg_speed';
            if ($request->direction == 'asc') {
                $direction = 'desc';
            }
            else {
                $direction = 'asc';
            }
        }

        // Загрузка страницы без ajax
        $dictionaries = Dictionary::with('user', 'stats', 'report')
            ->with(['favorites' => function ($query) {
                return $query->where('user_id', Auth::id());
            }])
            ->whereHas('report', function ($query) {
                return $query->where('status_code', 'accept');
            })
            ->where('is_publish', 1)
            ->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
            })
            ->join('users', 'dictionaries.user_id', 'users.id')
            ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
            ->orderBy('stats.count_games', 'desc')
            ->paginate($paginate);

        if ($request->chapter == 'all') {
            if($request->type != 0) {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->whereHas('report', function ($query) {
                        return $query->where('status_code', 'accept');
                    })
                    ->where('is_publish', 1)
                    ->where('type_id', $request->type)
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->orderBy('stats.' . $column, $direction)
                    ->paginate($paginate);
            }
            else {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->whereHas('report', function ($query) {
                        return $query->where('status_code', 'accept');
                    })
                    ->where('is_publish', 1)
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->orderBy('stats.' . $column, $direction)
                    ->paginate($paginate);
            }
        }
        elseif ($request->chapter == 'my') {
            if($request->type != 0) {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->where('user_id', Auth::id())
                    ->where('type_id', $request->type)
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->orderBy('stats.' . $column, $direction)
                    ->paginate($paginate);
            }
            else {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->where('user_id', Auth::id())
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->orderBy('stats.' . $column, $direction)
                    ->paginate($paginate);
            }
        }
        elseif ($request->chapter == 'favs') {
            if($request->type != 0) {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->whereHas('report', function ($query) {
                        return $query->where('status_code', 'accept');
                    })
                    ->where('type_id', $request->type)
                    ->where('is_publish', 1)
                    ->where('user_id', '!=', Auth::id())
                    ->whereHas('favorites', function ($query) {
                        return $query->where('user_id', Auth::id());
                    })
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->orderBy('stats.' . $column, $direction)
                    ->paginate($paginate);
            }
            else {
                $dictionaries = Dictionary::with('user', 'stats', 'report')
                    ->with(['favorites' => function ($query) {
                        return $query->where('user_id', Auth::id());
                    }])
                    ->whereHas('favorites', function ($query) {
                        return $query->where('user_id', Auth::id());
                    })
                    ->whereHas('report', function ($query) {
                        return $query->where('status_code', 'accept');
                    })
                    ->where('is_publish', 1)
                    ->where('user_id', '!=', Auth::id())
                    ->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $request->search . '%');
                    })
                    ->join('users', 'dictionaries.user_id', 'users.id')
                    ->join('stats', 'dictionaries.id', '=', 'stats.dictionary_id')
                    ->orderBy('stats.' . $column, $direction)
                    ->paginate($paginate);
            }
        }

        return view('user.pages.dictionaries.dictionaries', [
            'dictionaries' => $dictionaries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Dictionary  $dictionary
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendComment(Request $request, Dictionary $dictionary)
    {
        if ($request->ajax())
        {
            $errors = Validator::make($request->all(), [
                'comment' => [
                    'required', 'string', 'max:200'
                ]
            ]);

            if ($errors->fails()) {
                return response()->json([
                    'errors' => $errors->errors(),
                    'message' => 'Указанные данные недействительны.'
                ], 422);
            }

            $comment = Comment::create([
                'user_id' => Auth::id(),
                'dictionary_id' => $request->dictionary_id,
                'comment' => $request->comment
            ]);

            return response()->json([
                'success' => 'success',
                'message' => 'Комментарий отправлен!'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::get();
        $types = Type::get();

        return view('user.pages.dictionaries.dictionaryCreate', [
            'languages' => $languages,
            'types' => $types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax())
        {
            $errors = Validator::make($request->all(), [
                'title' => [
                    'required', 'string', 'max:70'
                ],
                'description' => [
                    'required', 'string', 'max:300'
                ],
                'information' => [
                    'required', 'string', 'max:1000'
                ],
                'is_publish' => [
                    'required', 'boolean'
                ],
                'language' => [
                    'required', 'int'
                ],
                'type' => [
                    'required', 'int'
                ],
                'text' => [
                    'required'
                ]
            ]);

            if ($errors->fails()) {
                return response()->json([
                    'errors' => $errors->errors(),
                    'message' => 'Указанные данные недействительны.'
                ], 422);
            }

            $data = new Dictionary();

            $data->title = $request->title;
            $data->description = $request->description;
            $data->information = $request->information;
            $data->is_publish = $request->is_publish;
            $data->is_systemic = $request->is_systemic;
            $data->language_id = $request->language;
            $data->type_id = $request->type;
            $data->user_id = Auth::id();

            if ($request->type === '1') {
                $text = str_replace(["\n", "\n ", " \n", "  ", "   "], " ", $request->text);
                $text = str_replace(["\n", "\n ", " \n", "  ", "   "], " ", $text);
                $excerpts = array($text);
            }
            elseif ($request->type === '2') {
                $excerpts = Str::of($request->text)->explode("\n");
            }
            elseif ($request->type === '3') {
                $excerpts = Str::of($request->text)->explode("\n\n");
            }
            elseif ($request->type === '4') {
                $file = $request->file;
                if(File::extension($request->file)  == 'pdf'){

                    $content = ""; // Напиши считыватель


                    $words = explode(' ', $content);//$words = mb_str_split($content);
                    $excerpts = array();
                    $count_words = 3;
                    for($i = 0; $i < count($words); $i+=$count_words ){
                        $temp = array();
                        for($j = $i; $j < $count_words; $j += 1){
                            array_push($temp, $words[$j]);
                        }
                        array_push($excerpts, $temp);
                    }

                }
            }

            $data->save();

            foreach ($excerpts as $excerpt) {
                $dataExcerpt = new Excerpt();
                $dataExcerpt->dictionary_id = $data->id;
                $dataExcerpt->excerpt = $excerpt;
                $dataExcerpt->save();
            }

            $stats = new Stats();
            $stats->dictionary_id = $data->id;
            $stats->save();

            $report = new Report();
            $report->dictionary_id = $data->id;
            if ($data->is_systemic == 1) {
                $report->status_code = 'accept';
                $report->status_text = 'Принят';
            }
            $report->save();

            return response()->json([
                'success' => 'success',
                'message' => 'Словарь успешно добавлен! Через секунду вы будете перенаправлены.',
                'route' => route('dictionaries.show', $data->id)
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function show(Dictionary $dictionary)
    {
//        dd($dictionary);
        $response = Dictionary::where('id', $dictionary->id)
            ->with('language')
            ->with('type')
            ->with('excerpts')
            ->with('user')
            ->with('report')
            ->with(['comments' => function ($query) {
                return $query->orderBy('created_at', 'DESC')
                    ->limit(10);
            }])
            ->with(['favorites' => function ($query) {
                return $query->where('user_id', Auth::id());
            }])
            ->with(['grades' => function ($query) {
                return $query->where('user_id', Auth::id());
            }])
            ->first();

        if ($response->is_publish == 0) {
            if (Auth::id() != $response->user_id) {
                return abort(403);
            }
        }

        if ($response->report->status_code != 'accept') {
            if (Auth::id() != $response->user_id) {
                return abort(403);
            }
        }

        return view('user.pages.dictionaries.show.info.dictionary', [
            'dictionary' => $response
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function showRecords(Dictionary $dictionary, Request $request)
    {
        $response = Dictionary::where('id', $dictionary->id)
            ->with('language')
            ->with('type')
            ->with('excerpts')
            ->with('user')
            ->with(['comments' => function ($query) {
                return $query->orderBy('created_at', 'DESC')
                    ->limit(10);
            }])
            ->with(['favorites' => function ($query) {
                return $query->where('user_id', Auth::id());
            }])
            ->with(['grades' => function ($query) {
                return $query->where('user_id', Auth::id());
            }])
            ->first();

        if ($request->ajax()) {
            $records = Game::select('user_id',
                DB::raw('MAX(avg_speed) as max_speed'),
                DB::raw('AVG(avg_speed) as avg_speed'),
                DB::raw('AVG(percent_mistakes) as avg_mistakes'))
                ->where('dictionary_id', $dictionary->id)
                ->when($request->sort == 'now', function ($query) {
                    $query->whereDate('created_at', Carbon::now());
                })
                ->when($request->sort == 'week', function ($query) {
                    $query->whereDate('created_at', '<=', Carbon::now())
                        ->whereDate('created_at', '>=', Carbon::now()->subDays(7));
                })
                ->groupBy('user_id')
                ->orderBy('max_speed', 'DESC')
                ->paginate(30);

            return response()->json([
                'dictionary' => $dictionary,
                'view' => view('user.pages.dictionaries.show.records.components.table', [
                    'records' => $records
                ])->render()
            ]);
        }

        $records = Game::select('user_id',
            DB::raw('MAX(avg_speed) as max_speed'),
            DB::raw('AVG(avg_speed) as avg_speed'),
            DB::raw('AVG(percent_mistakes) as avg_mistakes'))
            ->where('dictionary_id', $dictionary->id)
            ->when($request->sort == 'now', function ($query) {
                $query->whereDate('created_at', Carbon::now());
            })
            ->when($request->sort == 'week', function ($query) {
                $query->whereDate('created_at', '<=', Carbon::now())
                    ->whereDate('created_at', '>=', Carbon::now()->subDays(7));
            })
            ->groupBy('user_id')
            ->orderBy('max_speed', 'DESC')
            ->paginate(30);

        if ($dictionary->is_publish == 0) {
            if (Auth::id() != $dictionary->user_id) {
                return abort(403);
            }
        }

        return view('user.pages.dictionaries.show.records.dictionary', [
            'dictionary' => $response,
            'records' => $records
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function edit(Dictionary $dictionary)
    {
        $user = Auth::user();
        if ($user->cannot('update', $dictionary)) {
            return redirect()->back();
        }

        $languages = Language::get();
        $types = Type::get();

        $response = Dictionary::where('id', $dictionary->id)
            ->with('language')
            ->with('type')
            ->with('excerpts')
            ->with('user')
            ->first();

        return view('user.pages.dictionaries.dictionaryEdit', [
            'dictionary' => $response,
            'languages' => $languages,
            'types' => $types
        ]);
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
        $user = Auth::user();
        if ($user->cannot('update', $dictionary)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Недостаточно прав!'
            ], 422);
        }
        if ($request->ajax())
        {
            $errors = Validator::make($request->all(), [
                'title' => [
                    'required', 'string', 'max:70'
                ],
                'description' => [
                    'required', 'string', 'max:300'
                ],
                'information' => [
                    'required', 'string', 'max:1000'
                ],
                'is_publish' => [
                    'required', 'boolean'
                ],
                'language' => [
                    'required', 'int'
                ],
                'type' => [
                    'required', 'int'
                ],
                'text' => [
                    'required'
                ]
            ]);

            if ($errors->fails()) {
                return response()->json([
                    'errors' => $errors->errors(),
                    'message' => 'Указанные данные недействительны.'
                ], 422);
            }

            $dictionary->update([
                'title' => $request->title,
                'description' => $request->description,
                'information' => $request->information,
                'is_publish' => $request->is_publish,
                'language_id' => $request->language,
                'type_id' => $request->type
            ]);

            if ($dictionary->is_systemic == 0) {
                $dictionary->report()->update([
                    'status_code' => 'wait'
                ]);
            }

            if ($request->type === '1') {
                $text = str_replace(["\n", "\n ", " \n", "  ", "   "], " ", $request->text);
                $text = str_replace(["\n", "\n ", " \n", "  ", "   "], " ", $text);
                $excerpts = array($text);
            }
            elseif ($request->type === '2') {
                $excerpts = Str::of($request->text)->explode("\n");
            }
            elseif ($request->type === '3') {
                $excerpts = Str::of($request->text)->explode("\n\n");
            }
            elseif ($request->type === '4') {
                $file = $request->file;
                if(File::extension($request->file)  == 'pdf'){

                    $content = ""; // Напиши считыватель


                    $words = explode(' ', $content);//$words = mb_str_split($content);
                    $excerpts = array();
                    $count_words = 3;
                    for($i = 0; $i < count($words); $i+=$count_words ){
                        $temp = array();
                        for($j = $i; $j < $count_words; $j += 1){
                            array_push($temp, $words[$j]);
                        }
                        array_push($excerpts, $temp);
                    }

                }
            }

            Excerpt::where('dictionary_id', $dictionary->id)->delete();

            foreach ($excerpts as $excerpt) {
                $dataExcerpt = new Excerpt();
                $dataExcerpt->dictionary_id = $dictionary->id;
                $dataExcerpt->excerpt = $excerpt;
                $dataExcerpt->save();
            }

            return response()->json([
                'success' => 'success',
                'message' => 'Словарь успешно обновлен! Через секунду вы будете перенаправлены.',
                'route' => route('dictionaries.show', $dictionary->id)
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dictionary $dictionary)
    {
        $user = Auth::user();
        if ($user->cannot('delete', $dictionary)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Недостаточно прав!'
            ], 422);
        }

        if ($dictionary->delete()) {
            return response()->json([
                'success' => 'success',
                'message' => 'Словарь удален! Через секунду вы будете перенаправлены.',
                'route' => route('dictionaries.index')
            ]);
        }
        else {
            return response()->json([
                'error' => 'error',
                'message' => 'Ошибка при удалении словаря!'
            ], 404);
        }
    }
}
