@extends('layouts.app')

@section('title', 'Reset Password - Profil Digital Desa Wonokarang')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 pt-32">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="flex justify-center">
                <div class="w-16 h-16git rounded-full flex items-center justify-center">
                   <img src="{{ asset('img/logo_sidoarjo.png') }}" alt="Logo Sidoarjo"
                        class="w-full h-full object-contain">
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold text-primary">
                Reset Password
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Reset password untuk akses admin Desa Wonokarang
            </p>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-lg">
            <!-- Alert Messages -->
            <div id="alert-success" class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg items-center gap-3 hidden">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                <span id="success-message" class="text-green-700"></span>
            </div>

            <div id="alert-error" class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg items-center gap-3 hidden">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600"></i>
                <span id="error-message" class="text-red-700"></span>
            </div>

            <form id="reset-form" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Administrator
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="admin@wonokarang.desa.id"
                        />
                    </div>
                    <div id="email-error" class="text-red-600 text-sm mt-1 hidden"></div>
                </div>

                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password Baru
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input
                            id="new_password"
                            name="new_password"
                            type="password"
                            required
                            class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Masukkan password baru (min. 6 karakter)"
                        />
                        <button
                            type="button"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            onclick="togglePassword('new_password', 'new-password-icon')"
                        >
                            <i data-lucide="eye" id="new-password-icon" class="h-5 w-5 text-gray-400"></i>
                        </button>
                    </div>
                    <div id="new_password-error" class="text-red-600 text-sm mt-1 hidden"></div>
                </div>

                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password Baru
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input
                            id="new_password_confirmation"
                            name="new_password_confirmation"
                            type="password"
                            required
                            class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Ulangi password baru"
                        />
                        <button
                            type="button"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            onclick="togglePassword('new_password_confirmation', 'confirm-password-icon')"
                        >
                            <i data-lucide="eye" id="confirm-password-icon" class="h-5 w-5 text-gray-400"></i>
                        </button>
                    </div>
                    <div id="new_password_confirmation-error" class="text-red-600 text-sm mt-1 hidden"></div>
                </div>

                <div>
                    <button
                        type="submit"
                        id="submit-btn"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span id="btn-text">Reset Password</span>
                        <div id="btn-loading" class="hidden ml-2">
                            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                        </div>
                    </button>
                </div>
            </form>

            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <div class="flex items-start">
                    <i data-lucide="info" class="w-5 h-5 text-yellow-600 mt-0.5 mr-3 flex-shrink-0"></i>
                    <div>
                        <h4 class="text-sm font-medium text-yellow-800 mb-1">Peringatan Keamanan</h4>
                        <p class="text-sm text-yellow-700">
                            Fitur ini khusus untuk administrator. Pastikan Anda memiliki otoritas untuk mereset password admin.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-primary hover:text-blue-800 font-medium transition-colors mr-4">
                ← Kembali ke Login
            </a>
           
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="success-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                <i data-lucide="check" class="h-6 w-6 text-green-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-4">Password Berhasil Direset!</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Password admin telah berhasil direset. Anda dapat login menggunakan password baru.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button
                    id="modal-ok-btn"
                    class="px-4 py-2 bg-green-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300"
                >
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const passwordIcon = document.getElementById(iconId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.setAttribute('data-lucide', 'eye-off');
    } else {
        passwordInput.type = 'password';
        passwordIcon.setAttribute('data-lucide', 'eye');
    }
    
    lucide.createIcons();
}

// Handle form submission
document.getElementById('reset-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submit-btn');
    const btnText = document.getElementById('btn-text');
    const btnLoading = document.getElementById('btn-loading');
    
    // Reset previous errors
    clearErrors();
    
    // Show loading state
    submitBtn.disabled = true;
    btnText.textContent = 'Memproses...';
    btnLoading.classList.remove('hidden');
    
    try {
        const formData = new FormData(this);
        
        const response = await fetch('{{ route("reset.password.submit") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const result = await response.json();
        
        if (response.ok && result.success) {
            // Show success modal
            document.getElementById('success-modal').classList.remove('hidden');
            // Reset form
            this.reset();
        } else {
            // Handle validation errors
            if (result.errors) {
                showValidationErrors(result.errors);
            } else {
                showError(result.message || 'Terjadi kesalahan saat memproses permintaan');
            }
        }
    } catch (error) {
        console.error('Error:', error);
        showError('Terjadi kesalahan jaringan. Pastikan koneksi internet Anda stabil.');
    } finally {
        // Reset button state
        submitBtn.disabled = false;
        btnText.textContent = 'Reset Password';
        btnLoading.classList.add('hidden');
    }
});

function clearErrors() {
    // Clear validation errors
    const errorElements = document.querySelectorAll('[id$="-error"]');
    errorElements.forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });
    
    // Clear alert messages
    document.getElementById('alert-error').classList.add('hidden');
    document.getElementById('alert-success').classList.add('hidden');
}

function showError(message) {
    const alertError = document.getElementById('alert-error');
    const errorMessage = document.getElementById('error-message');
    
    errorMessage.textContent = message;
    alertError.classList.remove('hidden');
    alertError.classList.add('flex');
    
    // Scroll to top to show error
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function showValidationErrors(errors) {
    Object.keys(errors).forEach(field => {
        const errorElement = document.getElementById(field + '-error');
        if (errorElement) {
            errorElement.textContent = errors[field][0];
            errorElement.classList.remove('hidden');
        }
    });
}

// Handle success modal
document.getElementById('modal-ok-btn').addEventListener('click', function() {
    document.getElementById('success-modal').classList.add('hidden');
    // Redirect to login page
    window.location.href = '{{ route("login") }}';
});

// Close modal when clicking outside
document.getElementById('success-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.add('hidden');
        window.location.href = '{{ route("login") }}';
    }
});

// Initialize Lucide icons
lucide.createIcons();
</script>
@endsection
