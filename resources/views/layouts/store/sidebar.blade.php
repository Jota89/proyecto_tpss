<div class="flex-shrink-0 p-3 bg-white col-md-3 border-end">
    <ul id="filters" class="list-unstyled ps-0 mt-2">
        <li class="mb-1">
            <a class="btn btn-toggle align-items-center rounded collapsed w-100 justify-content-between" data-bs-toggle="collapse" data-bs-target="#marcas-collapse" aria-expanded="true">
            Marcas
            </a>
            <div class="collapse show" id="marcas-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ">
                    @foreach($categorias as $item)
                        <li class="nav-item">
                            <a role="button" class="nav-link link-dark">
                                <div class="form-check">
                                    <label class="form-check-label" for="{{ str_replace(" ","_",strtolower($item->nombre)) }}">
                                        <input class="form-check-input categoria" 
                                            @if (request()->route()->parameters)
                                                @if ((request()->route()->parameters['name']) == str_replace(" ","_",strtolower($item->nombre)))
                                                    checked
                                                    disabled
                                                @endif
                                            @endif

                                            type="checkbox" value="{{ $item->id }}" 
                                            name="marcas[]" 
                                            id="{{ str_replace(" ","_",strtolower($item->nombre)) }}">
                                        {{ $item->nombre }}
                                    </label>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
        <li class="border-top my-3"></li>
        <li class="mb-1">
            <a class="btn btn-toggle align-items-center rounded collapsed w-100 justify-content-between" data-bs-toggle="collapse" data-bs-target="#colores-collapse" aria-expanded="false">
            Colores
            </a>
            <div class="collapse" id="colores-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ">
                    @foreach($colores as $item)
                        <li class="nav-item">
                            <a role="button" class="nav-link link-dark">
                                <div class="form-check">
                                    <label class="form-check-label" for="{{ str_replace(" ","_",strtolower($item->nombre)) }}">
                                        <input class="form-check-input" 
                                            {{-- checked="{{ (request()->route()->parameters == strtolower($item->nombre)) ? 'checked' : '' }}" --}}
                                            type="checkbox" value="{{ $item->id }}" 
                                            name="marcas[]" 
                                            id="{{ str_replace(" ","_",strtolower($item->nombre)) }}">
                                        {{ $item->nombre }}
                                    </label>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
        <li class="border-top my-3"></li>
        <li class="mb-1">
            <a class="btn btn-toggle align-items-center rounded collapsed w-100 justify-content-between" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
            Capacidad
            </a>
            <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ">
                    @foreach($capacidades as $item)
                        <li class="nav-item">
                            <a role="button" class="nav-link link-dark">
                                <div class="form-check">
                                    <label class="form-check-label" for="{{ str_replace(" ","_",strtolower($item->nombre)) }}">
                                        <input class="form-check-input" 
                                            {{-- checked="{{ (request()->route()->parameters == strtolower($item->nombre)) ? 'checked' : '' }}" --}}
                                            type="checkbox" value="{{ $item->id }}" 
                                            name="marcas[]" 
                                            id="{{ str_replace(" ","_",strtolower($item->nombre)) }}">
                                        {{ $item->nombre }}
                                    </label>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
        <li class="border-top my-3"></li>
    </ul>
</div>