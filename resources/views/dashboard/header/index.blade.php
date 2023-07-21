@extends('layouts.dashboard.app')

@section('content')


    <div class="d-flex align-items-center justify-content-between mb-3">
        <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-semibold">
            <li class="breadcrumb-item pe-3 "><a href="#" class="pe-3 text-muted">الرئيسية</a></li>
            <li class="breadcrumb-item pe-3"><a href="#" class="pe-3 text-muted">الاعدادات</a></li>
            <li class="breadcrumb-item pe-3 text-primary"> القوائم   </li>
        </ol>
    </div>
    <div class="card">
        <div class="card-body fs-6 p-5 text-gray-700">
            <form action="{{ route('dashboard.headers.store')  }}" method="post">
                @csrf
                @method('post')
                @include('dashboard.partials._errors')

             
                       <label for="roleName" class="form-label fw-bolder d-block mt-3">  {{ trans('header.headers') }} </label>
                       @if($headers->count() !== 0) 
                   <div id="kt_docs_repeater_basic" class="repeater">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="kt_docs_repeater_basic">
                             @foreach($headers as $index=>$item)
                            <div data-repeater-item>
                                <div class="form-group row">
                                                                   
                                      <div class="form-group mb-4 col-md-3">
                                        <label for="roleName" class="form-label fw-bolder d-block text-capitalize">{{ trans('header.header_ar') }}</label>
                                             <input type="hidden" name="uuid" value="{{ $item->uuid}}">
                                        <input
                                            type="text"
                                            name='header_ar'
                                            class="form-control form-control-solid"     
                                            value="{{$item->getTranslation('name','ar')}}" placeholder="" >         
                                    </div>
                                    <div class="form-group mb-4 col-md-3">
                                        <label for="roleName" class="form-label fw-bolder d-block text-capitalize">{{ trans('header.header_en') }}</label>
                                        <input
                                            type="text"
                                            name='header_en'
                                            class="form-control form-control-solid"
                                            value="{{$item->getTranslation('name','en')}}" placeholder="" >
                                           
                                    </div>
                                     <div class="form-group mb-4 col-md-4">
                                        <label for="roleName" class="form-label fw-bolder d-block text-capitalize">{{ trans('header.url') }}</label>
                                          
                                             <select name="url" id="url" class="form-control">
                                                @php
                                                $url = $item->url;
                                                $lastWord = \Str::of($url)->afterLast('/');
                                            @endphp
                                                 
                                                {{-- <option value='{{route("$lastWord" ) }}' selected >{{ $lastWord }}</option> --}}
                                                <option value="{{ route('index') }}" {{ $lastWord== 'ar' ? 'selected' : '' }}>home</option>
                                                <option value="{{ route('about') }}" {{ $lastWord == 'about' ? 'selected' : '' }}>about</option>
                                                <option value="{{ route('product') }}" {{ $lastWord == 'product' ? 'selected' : '' }}>product</option>
                                                <option value="{{ route('contact') }}" {{ $lastWord == 'contact' ? 'selected' : '' }}>contact</option>
                                            </select>                             
                                     </div>

                                     <div class="form-group mb-4 col-md-2">
                                        <label for="roleName" class="form-label fw-bolder d-block text-capitalize">{{ trans('header.place') }}
                                          </label>
                                         <select name="place" id="place" class="form-control ">
                                                 {{-- <option value="{{ $item->place }}" selected>{{ $item->place }}</option> --}}
                                                <option value="header"{{$item->place == 'header'?'selected' : '' }} >header</option>
                                                <option value="footer" {{$item->place == 'footer'?'selected' : '' }} >footer</option>
                                               
                                            </select>                             
                                     </div>
      
                                    <div class="col-md-3">
                                     <button type="button" id="delete-resource" data-id="{{ $item->id }}" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8"> <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>Delete</button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                              @endforeach  
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group mt-5">
                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            اضف ميزه جديده
                        </a>
                    </div>
                    <!--end::Form group-->
                   </div>
                     
                           
                       @else
                       <div id="kt_docs_repeater_basic" class="repeater">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <div data-repeater-list="kt_docs_repeater_basic">
                                 
                                <div data-repeater-item>
                                    <div class="form-group row">
                                                                       
                                          <div class="form-group mb-4 col-md-3">
                                            <label for="roleName" class="form-label fw-bolder d-block text-capitalize">  {{ trans('header.header_ar') }} </label>
                                                
                                            <input
                                                type="text"
                                                name='header_ar'
                                                class="form-control form-control-solid"
                                                value="{{old('header_ar')}}" placeholder="" >
                                               
                                        </div>
                                        <div class="form-group mb-4 col-md-3">
                                            <label for="roleName" class="form-label fw-bolder d-block text-capitalize"> {{ trans('header.header_en') }}</label>
                                            <input
                                                type="text"
                                                name='header_en'
                                                class="form-control form-control-solid"
                                                value="{{old('header_en')}}" placeholder="" >
                                               
                                        </div>
                                         <div class="form-group mb-4 col-md-4">
                                            <label for="roleName" class="form-label fw-bolder d-block text-capitalize">  {{ trans('header.url') }} </label>
                                             <select name="url" id="url" class="form-control form-select">
                                                <option value="{{ route('index') }}">home</option>
                                                    <option value="{{ route('about') }}">about</option>
                                                    <option value="{{ route('product') }}">product</option>
                                                    <option value="{{ route('contact') }}">contact</option>
                                                </select>                             
                                         </div>
    
                                         <div class="form-group mb-4 col-md-2">
                                            <label for="roleName" class="form-label fw-bolder d-block text-capitalize">
                                              {{ trans('header.place') }}
                                            </label>
                                             <select name="place" id="place" class="form-control form-select">
                                                    <option value="header">header</option>
                                                    <option value="footer">footer</option>
                                                   
                                                </select>                             
                                         </div>
                 
                                        <div class="col-md-3">
                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                 {{ trans('header.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                
                            </div>
                        </div>
                        <!--end::Form group-->
    
                        <!--begin::Form group-->
                        <div class="form-group mt-5">
                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                <i class="ki-duotone ki-plus fs-3"></i>
                                   {{ trans('header.add') }}
                            </a>
                        </div>
                        <!--end::Form group-->
                       </div>
                       @endif

                                   
          <div class="text-end">
                            <button  class="px-20  mt-5 btn btn-primary btn-hover-rise me-5 fw-bolder">  حفظ  </button>
                        </div>
          
            </form>


        </div>
    </div>
@endsection

@push('js')
    <script>
$(document).on('click', '#delete-resource', function(e) {
    e.preventDefault();

    var resource_id = $(this).data('id');

    $.ajax({
        url: '{{ route("dashboard.headers.destroy", ":id") }}'.replace(':id', resource_id),
        type: 'DELETE',
        data: {
            '_token': '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log(66);
            // Handle the successful deletion of the resource
        },
        error: function(xhr) {
             console.log(55);
            // Handle the error
        }
    });
});
</script>
@endpush
