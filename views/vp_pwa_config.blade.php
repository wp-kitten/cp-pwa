@extends('admin.layouts.base')

@section('page-title')
    <title>{{__('cppwa::m.ValPress Progressive Web Application')}}</title>
@endsection

@section('main')

    <div class="app-title">
        <div class="cp-flex cp-flex--center cp-flex--space-between">
            <div>
                <h1>{{__('cppwa::m.Progressive Web Application')}}</h1>
            </div>
        </div>
    </div>

    @include('admin.partials.notices')

    @if(vp_current_user_can('administrator'))
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h4 class="tile-title">{{__("cppwa::m.Options")}}</h4>
                    <form action="{{route('admin.settings.vp_pwa.save')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="offline_page">{{__('cppwa::m.Offline page')}}</label>
                            <select id="offline_page" name="offline_page_id" class="form-control">
                                @forelse($pages as $page)
                                    @php $selected = ($page->id == $options['offline_page_id'] ? 'selected' : ''); @endphp
                                    <option value="{{$page->id}}" {!! $selected !!}>{{$page->title}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">{{__('cppwa::m.Name')}}</label>
                            <input type="text" id="name" name="name" value="{{$options['name']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="short_name">{{__('cppwa::m.Short Name')}}</label>
                            <input type="text" id="short_name" name="short_name" value="{{$options['short_name']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('cppwa::m.Short Description')}}</label>
                            <input type="text" id="description" name="description" value="{{$options['description']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="start_url">{{__('cppwa::m.Start URL')}}</label>
                            <input type="text" id="start_url" name="start_url" value="{{$options['start_url']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="background_color">{{__('cppwa::m.Background color')}}</label>
                            <input type="text" id="background_color" name="background_color" value="{{$options['background_color']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="theme_color">{{__('cppwa::m.Theme color')}}</label>
                            <input type="text" id="theme_color" name="theme_color" value="{{$options['theme_color']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="display">{{__('cppwa::m.Display as')}}</label>
                            <select id="display" name="display" class="form-control">
                                <option value="fullscreen" {!! $options['display'] == 'fullscreen' ? 'selected' : '' !!}>{{__('cppwa::m.Fullscreen')}}</option>
                                <option value="standalone" {!! $options['display'] == 'standalone' ? 'selected' : '' !!}>{{__('cppwa::m.Standalone')}}</option>
                                <option value="minimal-ui" {!! $options['display'] == 'minimal-ui' ? 'selected' : '' !!}>{{__('cppwa::m.Minimal UI')}}</option>
                                <option value="browser" {!! $options['display'] == 'browser' ? 'selected' : '' !!}>{{__('cppwa::m.Browser')}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h4>{{__('cppwa::m.Icons')}}</h4>
                        </div>
                        <div class="form-group">
                            <label for="icon_72x72">{{__('cppwa::m.Icon 72x72')}}</label>
                            <input type="text" id="icon_72x72" name="icon_72x72" value="{{$options['icons']['72x72']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_96x96">{{__('cppwa::m.Icon 96x96')}}</label>
                            <input type="text" id="icon_96x96" name="icon_96x96" value="{{$options['icons']['96x96']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_128x128">{{__('cppwa::m.Icon 128x128')}}</label>
                            <input type="text" id="icon_128x128" name="icon_128x128" value="{{$options['icons']['128x128']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_144x144">{{__('cppwa::m.Icon 144x144')}}</label>
                            <input type="text" id="icon_144x144" name="icon_144x144" value="{{$options['icons']['144x144']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_152x152">{{__('cppwa::m.Icon 152x152')}}</label>
                            <input type="text" id="icon_152x152" name="icon_152x152" value="{{$options['icons']['152x152']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_192x192">{{__('cppwa::m.Icon 192x192')}}</label>
                            <input type="text" id="icon_192x192" name="icon_192x192" value="{{$options['icons']['192x192']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_384x384">{{__('cppwa::m.Icon 384x384')}}</label>
                            <input type="text" id="icon_384x384" name="icon_384x384" value="{{$options['icons']['384x384']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_512x512">{{__('cppwa::m.Icon 512x512')}}</label>
                            <input type="text" id="icon_512x512" name="icon_512x512" value="{{$options['icons']['512x512']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_640x640">{{__('cppwa::m.Icon 640x640')}}</label>
                            <input type="text" id="icon_640x640" name="icon_640x640" value="{{$options['icons']['640x640']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_750x750">{{__('cppwa::m.Icon 750x750')}}</label>
                            <input type="text" id="icon_750x750" name="icon_750x750" value="{{$options['icons']['750x750']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_828x828">{{__('cppwa::m.Icon 828x828')}}</label>
                            <input type="text" id="icon_828x828" name="icon_828x828" value="{{$options['icons']['828x828']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_1125x1125">{{__('cppwa::m.Icon 1125x1125')}}</label>
                            <input type="text" id="icon_1125x1125" name="icon_1125x1125" value="{{$options['icons']['1125x1125']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_1242x1242">{{__('cppwa::m.Icon 1242x1242')}}</label>
                            <input type="text" id="icon_1242x1242" name="icon_1242x1242" value="{{$options['icons']['1242x1242']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_1536x1536">{{__('cppwa::m.Icon 1536x1536')}}</label>
                            <input type="text" id="icon_1536x1536" name="icon_1536x1536" value="{{$options['icons']['1536x1536']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_1668x1668">{{__('cppwa::m.Icon 1668x1668')}}</label>
                            <input type="text" id="icon_1668x1668" name="icon_1668x1668" value="{{$options['icons']['1668x1668']}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="icon_2048x2048">{{__('cppwa::m.Icon 2048x2048')}}</label>
                            <input type="text" id="icon_2048x2048" name="icon_2048x2048" value="{{$options['icons']['2048x2048']}}" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{__('cppwa::m.Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
