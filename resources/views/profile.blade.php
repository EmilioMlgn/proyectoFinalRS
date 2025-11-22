<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - ConnectCat</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('feed') }}">
                <i class="bi bi-chat-dots-fill text-primary"></i> ConnectCat
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('feed') }}">
                            <i class="bi bi-house-fill"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-search"></i> Explorar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notifications') }}">
                            <i class="bi bi-bell-fill"></i> Notificaciones
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('messages') }}">
                            <i class="bi bi-envelope-fill"></i> Mensajes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person-fill"></i> Perfil
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear-fill"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><span class="dropdown-item-text">{{ Auth::user()->name }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person"></i> Mi Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('settings') }}">
                                    <i class="bi bi-gear"></i> Configuración
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row">
            <!-- Contenido Principal del Perfil -->
            <div class="col-lg-8">
                <!-- Portada y Avatar -->
                <div class="card mb-4 shadow-sm border-0 overflow-hidden">
                    <!-- Banner de portada -->
                    <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start" style="margin-top: -100px; position: relative; z-index: 10;">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&size=128" 
                                 alt="{{ Auth::user()->name }}" class="rounded-circle border border-4 border-white" width="128" height="128">
                            <button class="btn btn-outline-primary rounded-pill">
                                <i class="bi bi-pencil"></i> Editar perfil
                            </button>
                        </div>

                        <div class="mt-3">
                            <h2 class="mb-0 fw-bold">{{ Auth::user()->name }}</h2>
                            <p class="text-muted mb-3">@{{ strtolower(str_replace(' ', '.', Auth::user()->name)) }}</p>
                            
                            <p class="mb-3">
                                <i class="bi bi-geo-alt"></i> España
                                <span class="mx-2">•</span>
                                <i class="bi bi-link-45deg"></i> 
                                <a href="#" class="text-decoration-none">www.ejemplo.com</a>
                                <span class="mx-2">•</span>
                                <i class="bi bi-calendar3"></i> Se unió en Noviembre de 2024
                            </p>

                            <p class="text-muted">
                                Desarrollador Full Stack apasionado por Laravel, Vue.js y tecnologías web modernas. ☕ 💻
                            </p>

                            <div class="d-flex gap-4 mb-3">
                                <div>
                                    <strong>156</strong>
                                    <div class="text-muted small">Siguiendo</div>
                                </div>
                                <div>
                                    <strong>342</strong>
                                    <div class="text-muted small">Seguidores</div>
                                </div>
                                <div>
                                    <strong>24</strong>
                                    <div class="text-muted small">Publicaciones</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pestañas de contenido -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-0">
                        <ul class="nav nav-underline" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab" aria-controls="posts" aria-selected="true">
                                    <i class="bi bi-chat-left-text"></i> Publicaciones
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="replies-tab" data-bs-toggle="tab" data-bs-target="#replies" type="button" role="tab" aria-controls="replies" aria-selected="false">
                                    <i class="bi bi-reply"></i> Respuestas
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="likes-tab" data-bs-toggle="tab" data-bs-target="#likes" type="button" role="tab" aria-controls="likes" aria-selected="false">
                                    <i class="bi bi-heart"></i> Me gusta
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab" aria-controls="media" aria-selected="false">
                                    <i class="bi bi-images"></i> Media
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contenido de Pestañas -->
                <div class="tab-content">
                    <!-- Publicaciones -->
                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex gap-3 mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" 
                                         alt="{{ Auth::user()->name }}" class="rounded-circle flex-shrink-0" width="48" height="48">
                                    <div class="flex-grow-1">
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <small class="text-muted d-block">@{{ strtolower(str_replace(' ', '.', Auth::user()->name)) }} • Hace 2 días</small>
                                    </div>
                                    <button class="btn btn-sm btn-light">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                </div>
                                <p class="card-text mb-3">Mi primer proyecto con Laravel y Vue.js se ve increíble. ¡El stack moderno es muy poderoso! 🚀</p>
                                <div class="ratio ratio-16x9 mb-3 bg-secondary rounded" style="background: url('https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=500') center/cover;"></div>
                                <div class="d-flex justify-content-between text-muted small">
                                    <button class="btn btn-sm btn-light text-muted">
                                        <i class="bi bi-heart"></i> 145
                                    </button>
                                    <button class="btn btn-sm btn-light text-muted">
                                        <i class="bi bi-chat"></i> 32
                                    </button>
                                    <button class="btn btn-sm btn-light text-muted">
                                        <i class="bi bi-share"></i> 8
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex gap-3 mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" 
                                         alt="{{ Auth::user()->name }}" class="rounded-circle flex-shrink-0" width="48" height="48">
                                    <div class="flex-grow-1">
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <small class="text-muted d-block">@{{ strtolower(str_replace(' ', '.', Auth::user()->name)) }} • Hace 1 semana</small>
                                    </div>
                                    <button class="btn btn-sm btn-light">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                </div>
                                <p class="card-text mb-0">Aprendiendo sobre optimización de bases de datos y consultas SQL complejas. #Laravel #Database</p>
                                <div class="d-flex justify-content-between text-muted small mt-3">
                                    <button class="btn btn-sm btn-light text-muted">
                                        <i class="bi bi-heart"></i> 87
                                    </button>
                                    <button class="btn btn-sm btn-light text-muted">
                                        <i class="bi bi-chat"></i> 12
                                    </button>
                                    <button class="btn btn-sm btn-light text-muted">
                                        <i class="bi bi-share"></i> 5
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Respuestas -->
                    <div class="tab-pane fade" id="replies" role="tabpanel" aria-labelledby="replies-tab">
                        <div class="alert alert-info text-center py-5">
                            <i class="bi bi-info-circle display-6"></i>
                            <p class="mt-3 mb-0">No hay respuestas aún</p>
                        </div>
                    </div>

                    <!-- Me gusta -->
                    <div class="tab-pane fade" id="likes" role="tabpanel" aria-labelledby="likes-tab">
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex gap-3 mb-3">
                                    <img src="https://ui-avatars.com/api/?name=María+López&background=random" 
                                         alt="María López" class="rounded-circle flex-shrink-0" width="48" height="48">
                                    <div class="flex-grow-1">
                                        <strong>María López</strong>
                                        <small class="text-muted d-block">@maria.lopez • Hace 3 horas</small>
                                    </div>
                                </div>
                                <p class="card-text mb-0">Tips para mejorar tu CSS y rendimiento web. #WebDevelopment #Performance</p>
                                <div class="d-flex justify-content-between text-muted small mt-3">
                                    <button class="btn btn-sm btn-light text-muted">
                                        <i class="bi bi-heart-fill text-danger"></i> 234
                                    </button>
                                    <button class="btn btn-sm btn-light text-muted">
                                        <i class="bi bi-chat"></i> 45
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media -->
                    <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300" alt="Imagen" class="img-fluid rounded shadow-sm">
                            </div>
                            <div class="col-md-6">
                                <img src="https://images.unsplash.com/photo-1633356122544-f134324ef6db?w=300" alt="Imagen" class="img-fluid rounded shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            @include('components.feed-sidebar')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
