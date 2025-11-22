{{-- Sidebar para la página del feed --}}
<aside class="col-lg-4">
    {{-- Búsqueda --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="input-group">
                <input type="text" class="form-control rounded-3" placeholder="Buscar usuarios, posts..." aria-label="Buscar">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Información del usuario --}}
    @auth
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" 
                         alt="{{ Auth::user()->name }}" class="rounded-circle me-3" width="48" height="48">
                    <div>
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <small class="text-muted">@{{ strtolower(str_replace(' ', '.', Auth::user()->name)) }}</small>
                    </div>
                </div>
                <div class="row text-center small mb-3">
                    <div class="col">
                        <strong>24</strong>
                        <div class="text-muted">Publicaciones</div>
                    </div>
                    <div class="col">
                        <strong>156</strong>
                        <div class="text-muted">Seguidores</div>
                    </div>
                    <div class="col">
                        <strong>89</strong>
                        <div class="text-muted">Siguiendo</div>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-primary w-100">
                    Ver perfil
                </a>
            </div>
        </div>
    @endauth

    {{-- Tendencias --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-header bg-light">
            <h6 class="mb-0">📈 Tendencias</h6>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action px-3 py-2 border-0">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong class="d-block">#Laravel</strong>
                            <small class="text-muted">45.2K posts</small>
                        </div>
                        <span class="text-muted">🔥</span>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action px-3 py-2 border-0">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong class="d-block">#WebDevelopment</strong>
                            <small class="text-muted">32.1K posts</small>
                        </div>
                        <span class="text-muted">🔥</span>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action px-3 py-2 border-0">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong class="d-block">#Programación</strong>
                            <small class="text-muted">28.7K posts</small>
                        </div>
                        <span class="text-muted">🔥</span>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action px-3 py-2 border-0">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong class="d-block">#PHP</strong>
                            <small class="text-muted">19.5K posts</small>
                        </div>
                        <span class="text-muted">🔥</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- Usuarios sugeridos --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-header bg-light">
            <h6 class="mb-0">👥 Usuarios sugeridos</h6>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <div class="list-group-item px-3 py-2 border-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=Juan+Carlos&background=random" 
                                 alt="Juan Carlos" class="rounded-circle me-2" width="32" height="32">
                            <div class="small">
                                <strong class="d-block">Juan Carlos</strong>
                                <span class="text-muted">@juan.carlos</span>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary rounded-pill">Seguir</button>
                    </div>
                    <small class="text-muted">Desarrollador Full Stack</small>
                </div>
                <div class="list-group-item px-3 py-2 border-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=María+López&background=random" 
                                 alt="María López" class="rounded-circle me-2" width="32" height="32">
                            <div class="small">
                                <strong class="d-block">María López</strong>
                                <span class="text-muted">@maria.lopez</span>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary rounded-pill">Seguir</button>
                    </div>
                    <small class="text-muted">Frontend Developer</small>
                </div>
                <div class="list-group-item px-3 py-2 border-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=Pedro+García&background=random" 
                                 alt="Pedro García" class="rounded-circle me-2" width="32" height="32">
                            <div class="small">
                                <strong class="d-block">Pedro García</strong>
                                <span class="text-muted">@pedro.garcia</span>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary rounded-pill">Seguir</button>
                    </div>
                    <small class="text-muted">DevOps Engineer</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Pie de página --}}
    <div class="card shadow-sm">
        <div class="card-body small text-muted">
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                <a href="#" class="text-decoration-none text-muted">Acerca de</a>
                <span class="mx-1">•</span>
                <a href="#" class="text-decoration-none text-muted">Privacidad</a>
                <span class="mx-1">•</span>
                <a href="#" class="text-decoration-none text-muted">Términos</a>
                <span class="mx-1">•</span>
                <a href="#" class="text-decoration-none text-muted">Ayuda</a>
            </div>
            <div class="text-center mt-2">
                <small>&copy; 2025 ConnectCat. Todos los derechos reservados.</small>
            </div>
        </div>
    </div>
</aside>
