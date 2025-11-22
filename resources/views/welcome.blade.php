<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">
        <header class="w-full text-sm border-b border-gray-200 dark:border-gray-700">
            @if (Route::has('login'))
                <nav class="max-w-4xl mx-auto flex items-center justify-between p-6">
                    <div class="text-xl font-semibold">
                        {{ config('app.name', 'Laravel') }}
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                </nav>
            @endif
        </header>

        <main class="flex-1 flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold mb-6 text-center">Iniciar Sesión</h2>

                    <form action="{{ route('login') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="usuario" class="block text-sm font-medium mb-2">Usuario</label>
                            <input 
                                id="usuario" 
                                name="usuario" 
                                type="text" 
                                required 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Ingresa tu usuario"
                                value="{{ old('usuario') }}"
                            >
                            @error('usuario')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium mb-2">Contraseña</label>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Ingresa tu contraseña"
                            >
                            @error('password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button 
                            type="submit" 
                            class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium transition"
                        >
                            Entrar
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600 dark:text-gray-400">
                            ¿No tienes cuenta? 
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                Regístrate aquí
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </main>

        <footer class="border-t border-gray-200 dark:border-gray-700 p-6 text-center text-gray-600 dark:text-gray-400 text-sm">
            <p>&copy; 2024 {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.</p>
        </footer>
    </body>
</html>
