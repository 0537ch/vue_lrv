<x-app-layout>
    @vite(['resources/css/profile.css'])
    
    <div id="app">
        <Profile 
            profile-image="/abrar.jpg"
            name="Abrar Ikramaputra"
            role="Mahasiswa Teknologi Rekayasa Internet"
            semester="Semester 7 angkatan 2021"
            :favorite-foods='@json(["Ayam Goreng", "Sayur Lodeh", "Es Teh"])'
        />
    </div>
</x-app-layout>