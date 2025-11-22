<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes - ConnectCat</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .messages-container {
            display: flex;
            height: calc(100vh - 120px);
        }
        .conversations-list {
            flex: 0 0 35%;
            border-right: 1px solid #e5e7eb;
            overflow-y: auto;
        }
        .chat-window {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #fff;
        }
        .chat-header {
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem;
        }
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .message-group {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .message-group.sent {
            justify-content: flex-end;
        }
        .message-group.received {
            justify-content: flex-start;
        }
        .message-bubble {
            padding: 0.75rem 1rem;
            border-radius: 18px;
            max-width: 60%;
            word-wrap: break-word;
        }
        .message-bubble.sent {
            background-color: #1d9bf0;
            color: white;
        }
        .message-bubble.received {
            background-color: #eff3f4;
            color: #0f1419;
        }
        .message-time {
            font-size: 0.75rem;
            color: #657786;
            margin-top: 0.25rem;
        }
        .chat-input-area {
            border-top: 1px solid #e5e7eb;
            padding: 1rem;
        }
        .conversation-item {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .conversation-item:hover {
            background-color: #f7f9fa;
        }
        .conversation-item.active {
            background-color: #f0f9ff;
            border-left: 4px solid #1d9bf0;
        }
        .no-conversation {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #657786;
        }
        @media (max-width: 768px) {
            .conversations-list {
                flex: 0 0 100%;
                display: none;
            }
            .conversations-list.active {
                display: block;
                flex: 0 0 100%;
            }
            .chat-window {
                flex: 1;
            }
            .message-bubble {
                max-width: 85%;
            }
        }
    </style>
</head>
<body class="bg-light">
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
        <div class="container-fluid">
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
                        <a class="nav-link active" href="{{ route('messages') }}">
                            <i class="bi bi-envelope-fill"></i> Mensajes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">
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

    <div class="container-fluid messages-container">
        <!-- Lista de Conversaciones -->
        <div class="conversations-list bg-white">
            <!-- Encabezado de mensajes -->
            <div class="p-3 border-bottom">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">✉️ Mensajes</h5>
                    <button class="btn btn-sm btn-light">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control bg-light border-0" placeholder="Buscar conversaciones...">
                </div>
            </div>

            <!-- Conversaciones -->
            <div class="conversation-item active" onclick="selectConversation(this)">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                        <img src="https://ui-avatars.com/api/?name=Juan+Carlos&background=random" 
                             alt="Juan Carlos" class="rounded-circle" width="48" height="48">
                        <div class="flex-grow-1 min-width-0">
                            <div class="d-flex justify-content-between">
                                <strong class="d-block">Juan Carlos</strong>
                                <small class="text-muted">Ahora</small>
                            </div>
                            <small class="text-muted text-truncate d-block">Claro, nos vemos en la reunión de.....</small>
                        </div>
                    </div>
                    <span class="badge bg-primary rounded-pill ms-2">1</span>
                </div>
            </div>

            <div class="conversation-item" onclick="selectConversation(this)">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                        <img src="https://ui-avatars.com/api/?name=María+López&background=random" 
                             alt="María López" class="rounded-circle" width="48" height="48">
                        <div class="flex-grow-1 min-width-0">
                            <div class="d-flex justify-content-between">
                                <strong class="d-block">María López</strong>
                                <small class="text-muted">Hace 2h</small>
                            </div>
                            <small class="text-muted text-truncate d-block">¡Me encanta tu publicación sobre CSS!</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="conversation-item" onclick="selectConversation(this)">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                        <img src="https://ui-avatars.com/api/?name=Pedro+García&background=random" 
                             alt="Pedro García" class="rounded-circle" width="48" height="48">
                        <div class="flex-grow-1 min-width-0">
                            <div class="d-flex justify-content-between">
                                <strong class="d-block">Pedro García</strong>
                                <small class="text-muted">Ayer</small>
                            </div>
                            <small class="text-muted text-truncate d-block">¿Ya viste el nuevo framework?</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="conversation-item" onclick="selectConversation(this)">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                        <img src="https://ui-avatars.com/api/?name=Ana+Martínez&background=random" 
                             alt="Ana Martínez" class="rounded-circle" width="48" height="48">
                        <div class="flex-grow-1 min-width-0">
                            <div class="d-flex justify-content-between">
                                <strong class="d-block">Ana Martínez</strong>
                                <small class="text-muted">Hace 3d</small>
                            </div>
                            <small class="text-muted text-truncate d-block">¿Tienes tiempo para hablar sobre el proyecto?</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="conversation-item" onclick="selectConversation(this)">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                        <img src="https://ui-avatars.com/api/?name=Carlos+López&background=random" 
                             alt="Carlos López" class="rounded-circle" width="48" height="48">
                        <div class="flex-grow-1 min-width-0">
                            <div class="d-flex justify-content-between">
                                <strong class="d-block">Carlos López</strong>
                                <small class="text-muted">Hace 1s</small>
                            </div>
                            <small class="text-muted text-truncate d-block">Estoy en directo ahora mismo</small>
                        </div>
                    </div>
                    <span class="badge bg-success rounded-pill ms-2" style="width: 8px; height: 8px;"></span>
                </div>
            </div>

            <div class="conversation-item" onclick="selectConversation(this)">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                        <img src="https://ui-avatars.com/api/?name=Sofía+Ruiz&background=random" 
                             alt="Sofía Ruiz" class="rounded-circle" width="48" height="48">
                        <div class="flex-grow-1 min-width-0">
                            <div class="d-flex justify-content-between">
                                <strong class="d-block">Sofía Ruiz</strong>
                                <small class="text-muted">Hace 5d</small>
                            </div>
                            <small class="text-muted text-truncate d-block">Gracias por la recomendación</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventana de Chat -->
        <div class="chat-window">
            <!-- Encabezado del Chat -->
            <div class="chat-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-sm btn-light d-lg-none" onclick="toggleConversationsList()">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                    <img src="https://ui-avatars.com/api/?name=Juan+Carlos&background=random" 
                         alt="Juan Carlos" class="rounded-circle" width="40" height="40">
                    <div>
                        <h6 class="mb-0">Juan Carlos</h6>
                        <small class="text-muted">@juan.carlos</small>
                    </div>
                </div>
                <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-light">
                        <i class="bi bi-info-circle"></i>
                    </button>
                </div>
            </div>

            <!-- Mensajes -->
            <div class="chat-messages">
                <div class="message-group received">
                    <div>
                        <div class="message-bubble received">
                            Hola, ¿cómo estás?
                        </div>
                        <div class="message-time">Hace 10 minutos</div>
                    </div>
                </div>

                <div class="message-group received">
                    <div>
                        <div class="message-bubble received">
                            ¿Ya revisaste el código que envié?
                        </div>
                        <div class="message-time">Hace 8 minutos</div>
                    </div>
                </div>

                <div class="message-group sent">
                    <div>
                        <div class="message-bubble sent">
                            Sí, me pareció muy bueno
                        </div>
                        <div class="message-time">Hace 5 minutos</div>
                    </div>
                </div>

                <div class="message-group sent">
                    <div>
                        <div class="message-bubble sent">
                            Tenemos que hacer algunos ajustes
                        </div>
                        <div class="message-time">Hace 4 minutos</div>
                    </div>
                </div>

                <div class="message-group received">
                    <div>
                        <div class="message-bubble received">
                            Claro, nos vemos en la reunión de mañana
                        </div>
                        <div class="message-time">Ahora</div>
                    </div>
                </div>
            </div>

            <!-- Área de Entrada -->
            <div class="chat-input-area">
                <div class="input-group">
                    <button class="btn btn-light" type="button">
                        <i class="bi bi-paperclip"></i>
                    </button>
                    <input type="text" class="form-control border" placeholder="Escribe un mensaje...">
                    <button class="btn btn-light" type="button">
                        <i class="bi bi-emoji-smile"></i>
                    </button>
                    <button class="btn btn-primary" type="button">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        function selectConversation(element) {
            // Remover clase active de todos
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.classList.remove('active');
            });
            // Agregar clase active al elemento clickeado
            element.classList.add('active');
            
            // En mobile, ocultar lista y mostrar chat
            if (window.innerWidth < 992) {
                toggleConversationsList();
            }
        }

        function toggleConversationsList() {
            const list = document.querySelector('.conversations-list');
            list.classList.toggle('active');
        }

        // Auto-scroll al final de los mensajes
        window.addEventListener('load', () => {
            const chatMessages = document.querySelector('.chat-messages');
            if (chatMessages) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>
</body>
</html>
