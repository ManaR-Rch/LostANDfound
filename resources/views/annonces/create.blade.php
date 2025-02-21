@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4 px-4">
    <!-- Bouton Dark Mode -->
    <div class="text-right mb-3">
        <button class="border border-gray-500 px-4 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700" id="toggleDarkMode">
            🌙 Mode sombre
        </button>
    </div>

    <div class="bg-gray-100 dark:bg-gray-800 shadow-lg p-6 rounded-lg">
        <h2 class="text-center text-2xl font-semibold mb-4">📝 Publier une annonce</h2>

        <!-- Gestion des erreurs -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Titre</label>
                <input type="text" name="titre" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="3" required></textarea>
            </div>

            <div>
                <label class="block font-medium">Catégorie</label>
                <select name="categorie" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <option value="vêtements">👕 Vêtements</option>
                    <option value="électronique">💻 Électronique</option>
                    <option value="clés">🔑 Clés</option>
                    <option value="autre">❓ Autre</option>
                </select>
            </div>

            <div>
                <label class="block font-medium">Lieu</label>
                <input type="text" name="lieu" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div>
                <label class="block font-medium">Date de perte/trouvaille</label>
                <input type="date" name="date_perdu_trouve" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div>
                <label class="block font-medium">Email de contact</label>
                <input type="email" name="contact_email" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div>
                <label class="block font-medium">Téléphone de contact</label>
                <input type="text" name="contact_telephone" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div>
                <label class="block font-medium">Photo (optionnel)</label>
                <input type="file" name="image" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-md">🚀 Publier</button>
        </form>
    </div>
</div>

<!-- Dark Mode Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleDarkMode = document.getElementById('toggleDarkMode');
        const body = document.body;

        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark');
        }

        toggleDarkMode.addEventListener('click', function () {
            body.classList.toggle('dark');

            if (body.classList.contains('dark')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        });
    });
</script>
@endsection
