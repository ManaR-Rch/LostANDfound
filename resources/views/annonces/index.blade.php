@extends('layouts.app')

@section('content')
<!-- Hero Section avec fond d'image et overlay coloré -->
<div class="relative bg-cover bg-center h-72" style="background-image: url('{{ asset('images/hero-background.jpg') }}')">
    <div class="absolute inset-0 bg-gradient-to-r from-purple-800/80 to-green-600/80"></div>
    <div class="relative max-w-5xl mx-auto px-8 h-full flex flex-col justify-center items-center text-white text-center">
        <h2 class="text-4xl font-bold mb-4 tracking-tight">Retrouvez ce qui compte pour vous</h2>
        <p class="text-xl max-w-2xl">Plateforme communautaire d'objets perdus et trouvés</p>
        <a href="{{ route('annonces.create') }}" class="mt-6 group inline-flex items-center px-6 py-3 bg-amber-400 text-gray-800 font-semibold rounded-lg shadow-lg transition transform hover:scale-105 hover:bg-amber-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Publier une annonce
        </a>
    </div>
</div>

<!-- Notification de succès avec animation -->
@if(session('success'))
    <div id="success-alert" class="max-w-5xl mx-auto mt-6 mb-2 px-8">
        <div class="p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 rounded-r-md shadow-md animate-fadeIn">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            alert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    </script>
@endif

<!-- Recherche avancée et filtres avec marges sur les côtés -->
<div class="max-w-5xl mx-auto my-8 px-8">
    <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-indigo-500">
        <form action="{{ route('annonces.index') }}" method="GET" class="space-y-4">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Que recherchez-vous ?" 
                              class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div class="md:w-auto">
                </div>
            </div>
            
            
            <div class="flex justify-between items-center">
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg shadow-md hover:bg-indigo-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Rechercher
                </button>
                <a href="{{ route('annonces.index') }}" class="text-indigo-600 hover:text-indigo-800 hover:underline">Réinitialiser les filtres</a>
            </div>
        </form>
    </div>
</div>

<!-- Affichage des annonces avec marges sur les côtés -->
@if($annonces->isEmpty())
    <div class="max-w-2xl mx-auto my-16 px-8">
        <div class="bg-white rounded-xl shadow-sm p-8 text-center border border-gray-200">
            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800">Aucune annonce trouvée</h3>
            <p class="mt-2 text-gray-600 max-w-md mx-auto">Il n'y a pas encore d'annonce correspondant à vos critères. Soyez le premier à en publier une !</p>
            <a href="{{ route('annonces.create') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Publier une annonce
            </a>
        </div>
    </div>
@else
    <div class="max-w-5xl mx-auto px-8 my-8">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <label for="sort" class="text-sm font-medium text-gray-600">Trier par:</label>
                <select id="sort" onchange="window.location.href = this.value" class="rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'recent']) }}" {{ request('sort') == 'recent' ? 'selected' : '' }}>Plus récentes</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'ancien']) }}" {{ request('sort') == 'ancien' ? 'selected' : '' }}>Plus anciennes</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($annonces as $annonce)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full group transform hover:-translate-y-1 hover:border-indigo-300 border border-transparent">
                    <div class="relative">
                        @if ($annonce->image)
                            <img src="{{ asset('storage/' . $annonce->image) }}" class="w-full h-56 object-cover" alt="{{ $annonce->titre }}">
                        @else
                            <div class="w-full h-56 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-{{ $annonce->type == 'perdu' ? 'rose' : 'emerald' }}-500 text-white text-sm font-semibold rounded-full shadow">
                                {{ $annonce->type == 'perdu' ? 'Perdu' : 'Trouvé' }}
                            </span>
                        </div>
                        @if($annonce->premium)
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-gradient-to-r from-amber-400 to-yellow-300 text-gray-800 text-sm font-medium rounded-full flex items-center shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Premium
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col bg-gradient-to-b from-white to-gray-50">
                        <div class="flex items-center mb-2">
                            <span class="text-sm text-gray-600 bg-{{ $annonce->categorie == 'electronique' ? 'blue' : ($annonce->categorie == 'bijoux' ? 'purple' : ($annonce->categorie == 'vetements' ? 'pink' : ($annonce->categorie == 'documents' ? 'orange' : 'gray'))) }}-100 px-2 py-1 rounded-md">
                                {{ $annonce->categorie ?? 'Non catégorisé' }}
                            </span>
                            <span class="ml-auto text-sm text-gray-500">{{ $annonce->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <h5 class="text-xl font-bold mb-2 text-gray-800 group-hover:text-indigo-700 transition-colors">{{ $annonce->titre }}</h5>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($annonce->description, 120) }}</p>
                        
                        @if($annonce->lieu)
                            <div class="flex items-start mt-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-600 text-sm">{{ $annonce->lieu }}</span>
                            </div>
                        @endif
                        
                        <a href="{{ route('annonces.show', $annonce->id) }}" class="mt-auto group inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all">
                            Voir l'annonce
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h3 class="text-xl font-semibold text-gray-800">{{ $annonce->titre }}</h3>
    <p class="text-gray-600">{{ $annonce->description }}</p>

    <!-- Liste des commentaires existants -->
    <div class="mt-4">
        <h4 class="text-lg font-semibold text-gray-700">Commentaires</h4>
        @foreach($annonce->commentaires as $commentaire)
            <div class="bg-gray-100 p-3 rounded-lg my-2">
                <p class="text-gray-700"><strong>{{ $commentaire->user->name }}</strong> : {{ $commentaire->contenu }}</p>
                <span class="text-sm text-gray-500">{{ $commentaire->created_at->diffForHumans() }}</span>
            </div>
        @endforeach
    </div>

    <!-- Formulaire d'ajout de commentaire -->
    @auth
        <form action="{{ route('commentaires.store', $annonce->id) }}" method="POST" class="mt-4">
            @csrf
            <div class="flex flex-col">
                <textarea name="contenu" rows="2" class="p-3 border rounded-lg w-full" placeholder="Ajouter un commentaire..." required></textarea>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Commenter</button>
            </div>
        </form>
    @else
        <p class="text-sm text-gray-500 mt-2">Veuillez <a href="{{ route('login') }}" class="text-blue-500 underline">vous connecter</a> pour commenter.</p>
    @endauth
</div>

                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
@endif

<!-- Statistiques avec fond coloré -->
<div class="bg-gradient-to-r from-indigo-50 to-purple-50 py-16 mt-16">
    <div class="max-w-5xl mx-auto px-8">
        <div class="text-center mb-12">
            <h3 class="text-2xl font-bold text-indigo-900">Notre communauté en chiffres</h3>
            <div class="w-20 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-600 mt-4">Rejoignez des milliers d'utilisateurs qui s'entraident chaque jour</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md text-center border-t-4 border-indigo-500 transform hover:scale-105 transition-transform">
                <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="text-indigo-600 text-3xl font-bold mb-2">{{ $stats['total'] ?? '0' }}</div>
                <div class="text-gray-600">Annonces publiées</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center border-t-4 border-emerald-500 transform hover:scale-105 transition-transform">
                <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="text-emerald-600 text-3xl font-bold mb-2">{{ $stats['found'] ?? '0' }}</div>
                <div class="text-gray-600">Objets retrouvés</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center border-t-4 border-purple-500 transform hover:scale-105 transition-transform">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="text-purple-600 text-3xl font-bold mb-2">{{ $stats['users'] ?? '0' }}</div>
                <div class="text-gray-600">Utilisateurs actifs</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center border-t-4 border-amber-500 transform hover:scale-105 transition-transform">
                <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <div class="text-amber-600 text-3xl font-bold mb-2">{{ $stats['success_rate'] ?? '0' }}%</div>
                <div class="text-gray-600">Taux de succès</div>
            </div>
        </div>
    </div>
</div>

<!-- Appel à l'action -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 py-16">
    <div class="max-w-5xl mx-auto px-8 text-center">
        <h3 class="text-3xl font-bold text-white mb-4">Vous avez perdu ou trouvé quelque chose ?</h3>
        <p class="text-indigo-100 mb-8 max-w-xl mx-auto">Rejoignez notre communauté et publiez gratuitement votre annonce en quelques clics.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('annonces.create') }}?type=perdu" class="px-8 py-4 bg-white text-indigo-700 font-semibold rounded-lg shadow-lg hover:bg-gray-100 transition">
                J'ai perdu un objet
            </a>
            <a href="{{ route('annonces.create') }}?type=trouve" class="px-8 py-4 bg-amber-400 text-gray-800 font-semibold rounded-lg shadow-lg hover:bg-amber-300 transition">
                J'ai trouvé un objet
            </a>
        </div>
    </div>
</div>

<!-- Script pour les filtres -->
<script>
function applyFilter(button, type) {
    // Reset all buttons to default style
    const buttons = button.parentElement.querySelectorAll('button');
    buttons.forEach(btn => {
        btn.classList.remove('bg-indigo-600', 'bg-rose-600', 'bg-emerald-600', 'text-white', 'border-indigo-600', 'border-rose-600', 'border-emerald-600');
        btn.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
    });
    
    // Style the selected button based on type
    button.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
    
    if (type === 'perdu') {
        button.classList.add('bg-rose-600', 'text-white', 'border-rose-600');
    } else if (type === 'trouve') {
        button.classList.add('bg-emerald-600', 'text-white', 'border-emerald-600');
    } else {
        button.classList.add('bg-indigo-600', 'text-white', 'border-indigo-600');
    }
    
    // Set the hidden input value
    document.getElementById('filter-type').value = type;
}
</script>
@endsection