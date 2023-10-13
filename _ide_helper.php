<?php
// @formatter:off
// phpcs:ignoreFile

/**
 * A helper file for Laravel, to provide autocomplete information to your IDE
 * Generated for Laravel 9.52.16.
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */

    namespace Maatwebsite\Excel\Facades { 
            /**
     * 
     *
     */ 
        class Excel {
                    /**
         * 
         *
         * @param object $export
         * @param string|null $fileName
         * @param string $writerType
         * @param array $headers
         * @return \Symfony\Component\HttpFoundation\BinaryFileResponse 
         * @throws \PhpOffice\PhpSpreadsheet\Exception
         * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
         * @static 
         */ 
        public static function download($export, $fileName, $writerType = null, $headers = [])
        {
                        /** @var \Maatwebsite\Excel\Excel $instance */
                        return $instance->download($export, $fileName, $writerType, $headers);
        }
                    /**
         * 
         *
         * @param object $export
         * @param string $filePath
         * @param string|null $disk
         * @param string $writerType
         * @param mixed $diskOptions
         * @return bool 
         * @throws \PhpOffice\PhpSpreadsheet\Exception
         * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
         * @static 
         */ 
        public static function store($export, $filePath, $diskName = null, $writerType = null, $diskOptions = [])
        {
                        /** @var \Maatwebsite\Excel\Excel $instance */
                        return $instance->store($export, $filePath, $diskName, $writerType, $diskOptions);
        }
                    /**
         * 
         *
         * @param object $export
         * @param string $filePath
         * @param string|null $disk
         * @param string $writerType
         * @param mixed $diskOptions
         * @return \Illuminate\Foundation\Bus\PendingDispatch 
         * @static 
         */ 
        public static function queue($export, $filePath, $disk = null, $writerType = null, $diskOptions = [])
        {
                        /** @var \Maatwebsite\Excel\Excel $instance */
                        return $instance->queue($export, $filePath, $disk, $writerType, $diskOptions);
        }
                    /**
         * 
         *
         * @param object $export
         * @param string $writerType
         * @return string 
         * @static 
         */ 
        public static function raw($export, $writerType)
        {
                        /** @var \Maatwebsite\Excel\Excel $instance */
                        return $instance->raw($export, $writerType);
        }
                    /**
         * 
         *
         * @param object $import
         * @param string|\Symfony\Component\HttpFoundation\File\UploadedFile $filePath
         * @param string|null $disk
         * @param string|null $readerType
         * @return \Maatwebsite\Excel\Reader|\Illuminate\Foundation\Bus\PendingDispatch 
         * @static 
         */ 
        public static function import($import, $filePath, $disk = null, $readerType = null)
        {
                        /** @var \Maatwebsite\Excel\Excel $instance */
                        return $instance->import($import, $filePath, $disk, $readerType);
        }
                    /**
         * 
         *
         * @param object $import
         * @param string|\Symfony\Component\HttpFoundation\File\UploadedFile $filePath
         * @param string|null $disk
         * @param string|null $readerType
         * @return array 
         * @static 
         */ 
        public static function toArray($import, $filePath, $disk = null, $readerType = null)
        {
                        /** @var \Maatwebsite\Excel\Excel $instance */
                        return $instance->toArray($import, $filePath, $disk, $readerType);
        }
                    /**
         * 
         *
         * @param object $import
         * @param string|\Symfony\Component\HttpFoundation\File\UploadedFile $filePath
         * @param string|null $disk
         * @param string|null $readerType
         * @return \Illuminate\Support\Collection 
         * @static 
         */ 
        public static function toCollection($import, $filePath, $disk = null, $readerType = null)
        {
                        /** @var \Maatwebsite\Excel\Excel $instance */
                        return $instance->toCollection($import, $filePath, $disk, $readerType);
        }
                    /**
         * 
         *
         * @param \Illuminate\Contracts\Queue\ShouldQueue $import
         * @param string|\Symfony\Component\HttpFoundation\File\UploadedFile $filePath
         * @param string|null $disk
         * @param string $readerType
         * @return \Illuminate\Foundation\Bus\PendingDispatch 
         * @static 
         */ 
        public static function queueImport($import, $filePath, $disk = null, $readerType = null)
        {
                        /** @var \Maatwebsite\Excel\Excel $instance */
                        return $instance->queueImport($import, $filePath, $disk, $readerType);
        }
                    /**
         * 
         *
         * @param string $concern
         * @param callable $handler
         * @param string $event
         * @static 
         */ 
        public static function extend($concern, $handler, $event = 'Maatwebsite\\Excel\\Events\\BeforeWriting')
        {
                        return \Maatwebsite\Excel\Excel::extend($concern, $handler, $event);
        }
                    /**
         * When asserting downloaded, stored, queued or imported, use regular expression
         * to look for a matching file path.
         *
         * @return void 
         * @static 
         */ 
        public static function matchByRegex()
        {
                        /** @var \Maatwebsite\Excel\Fakes\ExcelFake $instance */
                        $instance->matchByRegex();
        }
                    /**
         * When asserting downloaded, stored, queued or imported, use regular string
         * comparison for matching file path.
         *
         * @return void 
         * @static 
         */ 
        public static function doNotMatchByRegex()
        {
                        /** @var \Maatwebsite\Excel\Fakes\ExcelFake $instance */
                        $instance->doNotMatchByRegex();
        }
                    /**
         * 
         *
         * @param string $fileName
         * @param callable|null $callback
         * @static 
         */ 
        public static function assertDownloaded($fileName, $callback = null)
        {
                        /** @var \Maatwebsite\Excel\Fakes\ExcelFake $instance */
                        return $instance->assertDownloaded($fileName, $callback);
        }
                    /**
         * 
         *
         * @param string $filePath
         * @param string|callable|null $disk
         * @param callable|null $callback
         * @static 
         */ 
        public static function assertStored($filePath, $disk = null, $callback = null)
        {
                        /** @var \Maatwebsite\Excel\Fakes\ExcelFake $instance */
                        return $instance->assertStored($filePath, $disk, $callback);
        }
                    /**
         * 
         *
         * @param string $filePath
         * @param string|callable|null $disk
         * @param callable|null $callback
         * @static 
         */ 
        public static function assertQueued($filePath, $disk = null, $callback = null)
        {
                        /** @var \Maatwebsite\Excel\Fakes\ExcelFake $instance */
                        return $instance->assertQueued($filePath, $disk, $callback);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function assertQueuedWithChain($chain)
        {
                        /** @var \Maatwebsite\Excel\Fakes\ExcelFake $instance */
                        return $instance->assertQueuedWithChain($chain);
        }
                    /**
         * 
         *
         * @param string $classname
         * @param callable|null $callback
         * @static 
         */ 
        public static function assertExportedInRaw($classname, $callback = null)
        {
                        /** @var \Maatwebsite\Excel\Fakes\ExcelFake $instance */
                        return $instance->assertExportedInRaw($classname, $callback);
        }
                    /**
         * 
         *
         * @param string $filePath
         * @param string|callable|null $disk
         * @param callable|null $callback
         * @static 
         */ 
        public static function assertImported($filePath, $disk = null, $callback = null)
        {
                        /** @var \Maatwebsite\Excel\Fakes\ExcelFake $instance */
                        return $instance->assertImported($filePath, $disk, $callback);
        }
         
    }
     
}

    namespace Anhskohbo\NoCaptcha\Facades { 
            /**
     * 
     *
     */ 
        class NoCaptcha {
                    /**
         * Render HTML captcha.
         *
         * @param array $attributes
         * @return string 
         * @static 
         */ 
        public static function display($attributes = [])
        {
                        /** @var \Anhskohbo\NoCaptcha\NoCaptcha $instance */
                        return $instance->display($attributes);
        }
                    /**
         * 
         *
         * @see display()
         * @static 
         */ 
        public static function displayWidget($attributes = [])
        {
                        /** @var \Anhskohbo\NoCaptcha\NoCaptcha $instance */
                        return $instance->displayWidget($attributes);
        }
                    /**
         * Display a Invisible reCAPTCHA by embedding a callback into a form submit button.
         *
         * @param string $formIdentifier the html ID of the form that should be submitted.
         * @param string $text the text inside the form button
         * @param array $attributes array of additional html elements
         * @return string 
         * @static 
         */ 
        public static function displaySubmit($formIdentifier, $text = 'submit', $attributes = [])
        {
                        /** @var \Anhskohbo\NoCaptcha\NoCaptcha $instance */
                        return $instance->displaySubmit($formIdentifier, $text, $attributes);
        }
                    /**
         * Render js source
         *
         * @param null $lang
         * @param bool $callback
         * @param string $onLoadClass
         * @return string 
         * @static 
         */ 
        public static function renderJs($lang = null, $callback = false, $onLoadClass = 'onloadCallBack')
        {
                        /** @var \Anhskohbo\NoCaptcha\NoCaptcha $instance */
                        return $instance->renderJs($lang, $callback, $onLoadClass);
        }
                    /**
         * Verify no-captcha response.
         *
         * @param string $response
         * @param string $clientIp
         * @return bool 
         * @static 
         */ 
        public static function verifyResponse($response, $clientIp = null)
        {
                        /** @var \Anhskohbo\NoCaptcha\NoCaptcha $instance */
                        return $instance->verifyResponse($response, $clientIp);
        }
                    /**
         * Verify no-captcha response by Symfony Request.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return bool 
         * @static 
         */ 
        public static function verifyRequest($request)
        {
                        /** @var \Anhskohbo\NoCaptcha\NoCaptcha $instance */
                        return $instance->verifyRequest($request);
        }
                    /**
         * Get recaptcha js link.
         *
         * @param string $lang
         * @param boolean $callback
         * @param string $onLoadClass
         * @return string 
         * @static 
         */ 
        public static function getJsLink($lang = null, $callback = false, $onLoadClass = 'onloadCallBack')
        {
                        /** @var \Anhskohbo\NoCaptcha\NoCaptcha $instance */
                        return $instance->getJsLink($lang, $callback, $onLoadClass);
        }
         
    }
     
}

    namespace Spatie\LaravelIgnition\Facades { 
            /**
     * 
     *
     * @see \Spatie\FlareClient\Flare
     */ 
        class Flare {
                    /**
         * 
         *
         * @static 
         */ 
        public static function make($apiKey = null, $contextDetector = null)
        {
                        return \Spatie\FlareClient\Flare::make($apiKey, $contextDetector);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function setApiToken($apiToken)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->setApiToken($apiToken);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function apiTokenSet()
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->apiTokenSet();
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function setBaseUrl($baseUrl)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->setBaseUrl($baseUrl);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function setStage($stage)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->setStage($stage);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function sendReportsImmediately()
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->sendReportsImmediately();
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function determineVersionUsing($determineVersionCallable)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->determineVersionUsing($determineVersionCallable);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function reportErrorLevels($reportErrorLevels)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->reportErrorLevels($reportErrorLevels);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function filterExceptionsUsing($filterExceptionsCallable)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->filterExceptionsUsing($filterExceptionsCallable);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function filterReportsUsing($filterReportsCallable)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->filterReportsUsing($filterReportsCallable);
        }
                    /**
         * 
         *
         * @param array<class-string<ArgumentReducer>|ArgumentReducer>|\Spatie\Backtrace\Arguments\ArgumentReducers|null $argumentReducers
         * @static 
         */ 
        public static function argumentReducers($argumentReducers)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->argumentReducers($argumentReducers);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function withStackFrameArguments($withStackFrameArguments = true)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->withStackFrameArguments($withStackFrameArguments);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function version()
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->version();
        }
                    /**
         * 
         *
         * @return array<int, FlareMiddleware|class-string<FlareMiddleware>> 
         * @static 
         */ 
        public static function getMiddleware()
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->getMiddleware();
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function setContextProviderDetector($contextDetector)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->setContextProviderDetector($contextDetector);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function setContainer($container)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->setContainer($container);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function registerFlareHandlers()
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->registerFlareHandlers();
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function registerExceptionHandler()
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->registerExceptionHandler();
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function registerErrorHandler()
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->registerErrorHandler();
        }
                    /**
         * 
         *
         * @param \Spatie\FlareClient\FlareMiddleware\FlareMiddleware|array<FlareMiddleware>|\Spatie\FlareClient\class-string<FlareMiddleware>|callable $middleware
         * @return \Spatie\FlareClient\Flare 
         * @static 
         */ 
        public static function registerMiddleware($middleware)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->registerMiddleware($middleware);
        }
                    /**
         * 
         *
         * @return array<int,FlareMiddleware|class-string<FlareMiddleware>> 
         * @static 
         */ 
        public static function getMiddlewares()
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->getMiddlewares();
        }
                    /**
         * 
         *
         * @param string $name
         * @param string $messageLevel
         * @param array<int, mixed> $metaData
         * @return \Spatie\FlareClient\Flare 
         * @static 
         */ 
        public static function glow($name, $messageLevel = 'info', $metaData = [])
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->glow($name, $messageLevel, $metaData);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function handleException($throwable)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->handleException($throwable);
        }
                    /**
         * 
         *
         * @return mixed 
         * @static 
         */ 
        public static function handleError($code, $message, $file = '', $line = 0)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->handleError($code, $message, $file, $line);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function applicationPath($applicationPath)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->applicationPath($applicationPath);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function report($throwable, $callback = null, $report = null)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->report($throwable, $callback, $report);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function reportMessage($message, $logLevel, $callback = null)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->reportMessage($message, $logLevel, $callback);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function sendTestReport($throwable)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->sendTestReport($throwable);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function reset()
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->reset();
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function anonymizeIp()
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->anonymizeIp();
        }
                    /**
         * 
         *
         * @param array<int, string> $fieldNames
         * @return \Spatie\FlareClient\Flare 
         * @static 
         */ 
        public static function censorRequestBodyFields($fieldNames)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->censorRequestBodyFields($fieldNames);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function createReport($throwable)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->createReport($throwable);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function createReportFromMessage($message, $logLevel)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->createReportFromMessage($message, $logLevel);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function stage($stage)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->stage($stage);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function messageLevel($messageLevel)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->messageLevel($messageLevel);
        }
                    /**
         * 
         *
         * @param string $groupName
         * @param mixed $default
         * @return array<int, mixed> 
         * @static 
         */ 
        public static function getGroup($groupName = 'context', $default = [])
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->getGroup($groupName, $default);
        }
                    /**
         * 
         *
         * @static 
         */ 
        public static function context($key, $value)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->context($key, $value);
        }
                    /**
         * 
         *
         * @param string $groupName
         * @param array<string, mixed> $properties
         * @return \Spatie\FlareClient\Flare 
         * @static 
         */ 
        public static function group($groupName, $properties)
        {
                        /** @var \Spatie\FlareClient\Flare $instance */
                        return $instance->group($groupName, $properties);
        }
         
    }
     
}

    namespace Yajra\DataTables\Facades { 
            /**
     * 
     *
     * @mixin \Yajra\DataTables\DataTables
     * @see \Yajra\DataTables\DataTables
     */ 
        class DataTables {
                    /**
         * Make a DataTable instance from source.
         * 
         * Alias of make for backward compatibility.
         *
         * @param object $source
         * @return \Yajra\DataTables\DataTableAbstract 
         * @throws \Exception
         * @static 
         */ 
        public static function of($source)
        {
                        return \Yajra\DataTables\DataTables::of($source);
        }
                    /**
         * Make a DataTable instance from source.
         *
         * @param object $source
         * @return \Yajra\DataTables\DataTableAbstract 
         * @throws \Yajra\DataTables\Exceptions\Exception
         * @static 
         */ 
        public static function make($source)
        {
                        return \Yajra\DataTables\DataTables::make($source);
        }
                    /**
         * Get request object.
         *
         * @return \Yajra\DataTables\Utilities\Request 
         * @static 
         */ 
        public static function getRequest()
        {
                        /** @var \Yajra\DataTables\DataTables $instance */
                        return $instance->getRequest();
        }
                    /**
         * Get config instance.
         *
         * @return \Yajra\DataTables\Utilities\Config 
         * @static 
         */ 
        public static function getConfig()
        {
                        /** @var \Yajra\DataTables\DataTables $instance */
                        return $instance->getConfig();
        }
                    /**
         * DataTables using Query.
         *
         * @param \Illuminate\Contracts\Database\Query\Builder $builder
         * @return \Yajra\DataTables\QueryDataTable 
         * @static 
         */ 
        public static function query($builder)
        {
                        /** @var \Yajra\DataTables\DataTables $instance */
                        return $instance->query($builder);
        }
                    /**
         * DataTables using Eloquent Builder.
         *
         * @param \Illuminate\Contracts\Database\Eloquent\Builder $builder
         * @return \Yajra\DataTables\EloquentDataTable 
         * @static 
         */ 
        public static function eloquent($builder)
        {
                        /** @var \Yajra\DataTables\DataTables $instance */
                        return $instance->eloquent($builder);
        }
                    /**
         * DataTables using Collection.
         *
         * @param \Illuminate\Support\Collection<array-key, array>|array $collection
         * @return \Yajra\DataTables\CollectionDataTable 
         * @static 
         */ 
        public static function collection($collection)
        {
                        /** @var \Yajra\DataTables\DataTables $instance */
                        return $instance->collection($collection);
        }
                    /**
         * DataTables using Collection.
         *
         * @param \Illuminate\Http\Resources\Json\AnonymousResourceCollection<array-key, array>|array $resource
         * @return \Yajra\DataTables\ApiResourceDataTable|\Yajra\DataTables\DataTableAbstract 
         * @static 
         */ 
        public static function resource($resource)
        {
                        /** @var \Yajra\DataTables\DataTables $instance */
                        return $instance->resource($resource);
        }
                    /**
         * Get html builder instance.
         *
         * @return \Yajra\DataTables\Html\Builder 
         * @throws \Yajra\DataTables\Exceptions\Exception
         * @static 
         */ 
        public static function getHtmlBuilder()
        {
                        /** @var \Yajra\DataTables\DataTables $instance */
                        return $instance->getHtmlBuilder();
        }
                    /**
         * 
         *
         * @param string $engine
         * @param string $parent
         * @return void 
         * @throws \Yajra\DataTables\Exceptions\Exception
         * @static 
         */ 
        public static function validateDataTable($engine, $parent)
        {
                        /** @var \Yajra\DataTables\DataTables $instance */
                        $instance->validateDataTable($engine, $parent);
        }
                    /**
         * 
         *
         * @param string $engine
         * @param string $parent
         * @return void 
         * @throws \Yajra\DataTables\Exceptions\Exception
         * @static 
         */ 
        public static function throwInvalidEngineException($engine, $parent)
        {
                        /** @var \Yajra\DataTables\DataTables $instance */
                        $instance->throwInvalidEngineException($engine, $parent);
        }
                    /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @return void 
         * @static 
         */ 
        public static function macro($name, $macro)
        {
                        \Yajra\DataTables\DataTables::macro($name, $macro);
        }
                    /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void 
         * @throws \ReflectionException
         * @static 
         */ 
        public static function mixin($mixin, $replace = true)
        {
                        \Yajra\DataTables\DataTables::mixin($mixin, $replace);
        }
                    /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool 
         * @static 
         */ 
        public static function hasMacro($name)
        {
                        return \Yajra\DataTables\DataTables::hasMacro($name);
        }
                    /**
         * Flush the existing macros.
         *
         * @return void 
         * @static 
         */ 
        public static function flushMacros()
        {
                        \Yajra\DataTables\DataTables::flushMacros();
        }
         
    }
     
}

    namespace Illuminate\Support { 
            /**
     * 
     *
     * @template TKey of array-key
     * @template TValue
     * @implements \ArrayAccess<TKey, TValue>
     * @implements \Illuminate\Support\Enumerable<TKey, TValue>
     */ 
        class Collection {
                    /**
         * 
         *
         * @see \Maatwebsite\Excel\Mixins\DownloadCollection::downloadExcel()
         * @param string $fileName
         * @param string|null $writerType
         * @param mixed $withHeadings
         * @param array $responseHeaders
         * @static 
         */ 
        public static function downloadExcel($fileName, $writerType = null, $withHeadings = false, $responseHeaders = [])
        {
                        return \Illuminate\Support\Collection::downloadExcel($fileName, $writerType, $withHeadings, $responseHeaders);
        }
                    /**
         * 
         *
         * @see \Maatwebsite\Excel\Mixins\StoreCollection::storeExcel()
         * @param string $filePath
         * @param string|null $disk
         * @param string|null $writerType
         * @param mixed $withHeadings
         * @static 
         */ 
        public static function storeExcel($filePath, $disk = null, $writerType = null, $withHeadings = false)
        {
                        return \Illuminate\Support\Collection::storeExcel($filePath, $disk, $writerType, $withHeadings);
        }
         
    }
     
}

    namespace Illuminate\Http { 
            /**
     * 
     *
     */ 
        class Request {
                    /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestValidation()
         * @param array $rules
         * @param mixed $params
         * @static 
         */ 
        public static function validate($rules, ...$params)
        {
                        return \Illuminate\Http\Request::validate($rules, ...$params);
        }
                    /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestValidation()
         * @param string $errorBag
         * @param array $rules
         * @param mixed $params
         * @static 
         */ 
        public static function validateWithBag($errorBag, $rules, ...$params)
        {
                        return \Illuminate\Http\Request::validateWithBag($errorBag, $rules, ...$params);
        }
                    /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @param mixed $absolute
         * @static 
         */ 
        public static function hasValidSignature($absolute = true)
        {
                        return \Illuminate\Http\Request::hasValidSignature($absolute);
        }
                    /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @static 
         */ 
        public static function hasValidRelativeSignature()
        {
                        return \Illuminate\Http\Request::hasValidRelativeSignature();
        }
                    /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @param mixed $ignoreQuery
         * @param mixed $absolute
         * @static 
         */ 
        public static function hasValidSignatureWhileIgnoring($ignoreQuery = [], $absolute = true)
        {
                        return \Illuminate\Http\Request::hasValidSignatureWhileIgnoring($ignoreQuery, $absolute);
        }
         
    }
     
}


namespace  { 
            class Excel extends \Maatwebsite\Excel\Facades\Excel {}
            class NoCaptcha extends \Anhskohbo\NoCaptcha\Facades\NoCaptcha {}
            class Flare extends \Spatie\LaravelIgnition\Facades\Flare {}
            class DataTables extends \Yajra\DataTables\Facades\DataTables {}
     
}




