<!DOCTYPE html>
<html>
    <head>
        <title>@lang('Bagisto Installer')</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="base-url" content="{{ url()->to('/') }}">

        @stack('meta')

        @bagistoVite(['src/Resources/assets/css/app.css', 'src/Resources/assets/js/app.js'], 'installer')

        {{-- <link 
            type="image/x-icon"
            href="{{ Storage::url($favicon) }}" 
            rel="shortcut icon"
            sizes="16x16"
        > --}}
        
        @stack('styles')
    </head>

    <body>
        <div id="app" class="h-full">
            {{-- Flash Message Blade Component --}}
            <x-admin::flash-group />

            <div class="container">
                <div class="flex [&amp;>*]:w-[50%] justify-center items-center">
                    <div class="flex flex-col justify-center">
                        <div class="grid items-end max-w-[362px] m-auto h-[100vh]">
                            <div class="grid gap-[16px]">
                                <img src="../images/bagisto-logo.svg" alt="Bagisto Logo">
                                <div class="grid gap-[6px]">
                                    <p class="text-gray-800 text-[20px] font-bold">Welcome to Installation</p>
                                    <p class="text-gray-600 text-[14px]">We are happy to see you here!</p>
                                </div>
                                <p class="text-gray-600 text-[14px]">Bagisto installation typically involves several steps.
                                    Here's a general outline of the installation process for Bagisto:</p>
                                <div class="grid gap-[12px]">
                                    <div class="flex gap-[4px] text-[14px] font-bold text-gray-600">
                                        <span class=""></span>
                                        <p>Server Requirments</p>
                                    </div>
                                    <div class="flex gap-[4px] text-[14px] text-gray-600">
                                        <span class=""></span>
                                        <p>Environment Configuration</p>
                                    </div>
                                    <div class="flex gap-[4px] text-[14px] text-gray-600">
                                        <span class=""></span>
                                        <p>Ready for Installation</p>
                                    </div>
                                    <div class="flex gap-[4px] text-[14px] text-gray-600">
                                        <span class=""></span>
                                        <p>Create Administrator</p>
                                    </div>
                                    <div class="flex gap-[4px] text-[14px] text-gray-600">
                                        <span class=""></span>
                                        <p>Email Configuration</p>
                                    </div>
                                    <div class="flex gap-[4px] text-[14px] text-gray-600">
                                        <span class=""></span>
                                        <p>Installation Completed</p>
                                    </div>
                                </div>
                            </div>
                            <p class="place-self-end w-full text-left mb-[24px]"><a class="text-blue-500" href="https://bagisto.com/en/">Bagisto</a> a Community Project by <a class="text-blue-500" href="https://webkul.com/">Webkul</a></p>
                        </div>
                    </div>
                    <div class="">
                        <div class="w-full max-w-[568px] bg-white rounded-[8px] shadow-[0px_8px_10px_0px_rgba(0,0,0,0.05)] border-[1px] border-gray-300">
                            <div class="flex justify-between items-center gap-[10px] px-[16px] py-[11px] border-b-[1px] border-gray-300">
                                <p class="text-[20px] text-gray-800 font-bold">Installation</p>
                                <span class="icon-cross text-[24px] p-[6px] cursor-pointer"></span>
                            </div>
                            <div class="flex flex-col gap-[15px] justify-center px-[30px] py-[16px] border-b-[1px] border-gray-300 h-[484px] overflow-y-auto">
                                <div class="flex flex-col gap-[16px]">
                                    <p class="text-[18px] text-gray-800 font-semibold">Bagisto for Installation</p>
        
                                    <div class="grid gap-[10px]">
                                        <label class="text-[14px] text-gray-600">Click the button below to</label>
                                        <div class="grid gap-[12px]">
                                            <div class="flex gap-[4px] text-[14px] text-gray-600">
                                                <span class=""></span>
                                                <p>Create the database table</p>
                                            </div>
                                            <div class="flex gap-[4px] text-[14px] text-gray-600">
                                                <span class=""></span>
                                                <p>Populate the database tables</p>
                                            </div>
                                            <div class="flex gap-[4px] text-[14px] text-gray-600">
                                                <span class=""></span>
                                                <p>Publishing the vendor files</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex px-[16px] py-[10px] justify-between items-center">
                                <div class="text-[12px] text-blue-600 font-semibold cursor-pointer">Back</div>
                                <div class="px-[12px] py-[6px] bg-blue-600 border border-blue-700 rounded-[6px] text-gray-50 font-semibold cursor-pointer hover:opacity-90">
                                    Start Installation</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
