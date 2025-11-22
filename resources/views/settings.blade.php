<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - ConnectCat</title>
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
                        <a class="nav-link" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person-fill"></i> Perfil
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                <a class="dropdown-item active" href="{{ route('settings') }}">
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
            <!-- Panel de Configuración -->
            <div class="col-lg-8">
                <!-- Encabezado -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="card-title mb-0">⚙️ Configuración</h2>
                    </div>
                </div>

                <!-- Configuración de Cuenta -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">👤 Cuenta</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <p class="form-control-static">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nombre de usuario</label>
                                <p class="form-control-static">@{{ strtolower(str_replace(' ', '.', Auth::user()->name)) }}</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bi bi-key"></i> Cambiar contraseña
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-shield-check"></i> Autenticación de dos factores
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Preferencias de Privacidad -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">🔒 Privacidad y Seguridad</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="privatAccount" checked>
                                <label class="form-check-label" for="privatAccount">
                                    <strong>Cuenta privada</strong>
                                    <div class="small text-muted">Requiere aprobación para que otros te sigan</div>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="allowMessages">
                                <label class="form-check-label" for="allowMessages">
                                    <strong>Permitir mensajes de cualquiera</strong>
                                    <div class="small text-muted">Recibe mensajes incluso de usuarios que no sigues</div>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="allowMentions" checked>
                                <label class="form-check-label" for="allowMentions">
                                    <strong>Permitir menciones</strong>
                                    <div class="small text-muted">Otros usuarios pueden mencionarte en publicaciones</div>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="allowComments" checked>
                                <label class="form-check-label" for="allowComments">
                                    <strong>Permitir comentarios en tus publicaciones</strong>
                                    <div class="small text-muted">Otros usuarios pueden comentar tus posts</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preferencias de Notificaciones -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">🔔 Notificaciones</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notifFollowers" checked>
                                <label class="form-check-label" for="notifFollowers">
                                    <strong>Notificaciones de nuevos seguidores</strong>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notifLikes" checked>
                                <label class="form-check-label" for="notifLikes">
                                    <strong>Notificaciones de me gusta</strong>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notifComments" checked>
                                <label class="form-check-label" for="notifComments">
                                    <strong>Notificaciones de comentarios</strong>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notifMentions" checked>
                                <label class="form-check-label" for="notifMentions">
                                    <strong>Notificaciones de menciones</strong>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notifMessages" checked>
                                <label class="form-check-label" for="notifMessages">
                                    <strong>Notificaciones de mensajes</strong>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notifEmail">
                                <label class="form-check-label" for="notifEmail">
                                    <strong>Enviar notificaciones por email</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preferencias de Pantalla -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">🎨 Pantalla y Sonido</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tema</label>
                            <select class="form-select">
                                <option selected>Claro (recomendado)</option>
                                <option>Oscuro</option>
                                <option>Automático</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tamaño de fuente</label>
                            <select class="form-select">
                                <option>Pequeño</option>
                                <option selected>Normal (recomendado)</option>
                                <option>Grande</option>
                                <option>Muy grande</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="soundEnabled" checked>
                                <label class="form-check-label" for="soundEnabled">
                                    <strong>Sonidos habilitados</strong>
                                    <div class="small text-muted">Reproduce sonidos para notificaciones y eventos</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Datos y Privacidad -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">📊 Datos y Privacidad</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#downloadDataModal">
                                <i class="bi bi-download"></i> Descargar mis datos
                            </button>
                            <p class="small text-muted mt-2">Solicita un archivo con todos tus datos personales</p>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise"></i> Borrar historial de búsqueda
                            </button>
                            <p class="small text-muted mt-2">Limpia todo tu historial de búsquedas</p>
                        </div>
                    </div>
                </div>

                <!-- Peligro Zone -->
                <div class="card mb-4 shadow-sm border-0 border-danger">
                    <div class="card-header bg-danger bg-opacity-10">
                        <h5 class="mb-0 text-danger">⚠️ Zona de Peligro</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <p class="text-danger mb-2"><strong>Acciones permanentes</strong></p>
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deactivateModal">
                                <i class="bi bi-pause-circle"></i> Desactivar cuenta
                            </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                <i class="bi bi-trash"></i> Eliminar cuenta
                            </button>
                            <p class="small text-muted mt-2">Una vez eliminada, tu cuenta no se puede recuperar</p>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <button class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Guardar cambios
                        </button>
                        <button class="btn btn-light">
                            <i class="bi bi-arrow-clockwise"></i> Restaurar predeterminados
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            @include('components.feed-sidebar')
        </div>
    </div>

    <!-- Modal: Cambiar Contraseña -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordLabel">🔐 Cambiar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Contraseña actual</label>
                            <input type="password" class="form-control" id="currentPassword">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control" id="newPassword">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="confirmPassword">
                        </div>
                        <div class="alert alert-info small">
                            <i class="bi bi-info-circle"></i> La contraseña debe tener al menos 8 caracteres
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Cambiar contraseña</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Descargar Datos -->
    <div class="modal fade" id="downloadDataModal" tabindex="-1" aria-labelledby="downloadDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="downloadDataLabel">📥 Descargar mis Datos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Recibirás un email con un enlace para descargar un archivo con todos tus datos personales en formato JSON.</p>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> El enlace expirará en 7 días
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Solicitar descarga</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Desactivar Cuenta -->
    <div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning bg-opacity-10">
                    <h5 class="modal-title text-warning" id="deactivateLabel">⏸️ Desactivar Cuenta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Si desactivas tu cuenta:</p>
                    <ul>
                        <li>Tu perfil no será visible para otros usuarios</li>
                        <li>Tus publicaciones no serán visibles</li>
                        <li>Podrás reactivar tu cuenta en cualquier momento</li>
                        <li>Tus datos se conservarán durante 30 días</li>
                    </ul>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i> Esta acción se puede deshacer
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning">Desactivar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Eliminar Cuenta -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger bg-opacity-10">
                    <h5 class="modal-title text-danger" id="deleteAccountLabel">🗑️ Eliminar Cuenta Permanentemente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i> <strong>Advertencia:</strong> Esta acción es irreversible
                    </div>
                    <p>Si eliminas tu cuenta:</p>
                    <ul>
                        <li>Tu perfil se eliminará de forma permanente</li>
                        <li>Todas tus publicaciones serán eliminadas</li>
                        <li>Tus datos personales serán borrados</li>
                        <li><strong>No se puede deshacer esta acción</strong></li>
                    </ul>
                    <div class="form-group mt-3">
                        <label for="confirmEmail" class="form-label">Confirma tu email para continuar:</label>
                        <input type="email" class="form-control" id="confirmEmail" placeholder="{{ Auth::user()->email }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger">Eliminar cuenta permanentemente</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
