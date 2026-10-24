<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900">Pendaftaran Akun Baru</h2>
        <p class="text-xs text-gray-500 mt-1">Buat akun untuk mengajukan peminjaman inventaris sekolah.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">
                Nama Lengkap <span class="text-rose-500">*</span>
            </label>
            <input 
                id="name" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                placeholder="Contoh: Penguji 4 / Guru Sarpras"
                required 
                autofocus 
                autocomplete="name" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700">
                Alamat Email <span class="text-rose-500">*</span>
            </label>
            <input 
                id="email" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                placeholder="nama@sekolah.sch.id"
                required 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700">
                Password <span class="text-rose-500">*</span>
            </label>
            <input 
                id="password" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                type="password"
                name="password"
                placeholder="Minimal 8 karakter"
                required 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                Konfirmasi Password <span class="text-rose-500">*</span>
            </label>
            <input 
                id="password_confirmation" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                type="password"
                name="password_confirmation" 
                placeholder="Ketik ulang password"
                required 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div>
            <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-md shadow-sm transition">
                Daftar Akun Baru
            </button>
        </div>

        <div class="text-center pt-2">
            <span class="text-xs text-gray-500">Sudah memiliki akun?</span>
            <a class="text-xs text-indigo-600 hover:text-indigo-800 font-semibold ms-1" href="{{ route('login') }}">
                Masuk ke sistem
            </a>
        </div>
    </form>
</x-guest-layout>
