@extends('layouts.app')

@section('title', 'Tambah Santri')

@section('content')
<style>
    .form-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0.1;
        border-radius: 20px;
    }

    .form-inner {
        background: white;
        border-radius: 18px;
        position: relative;
        z-index: 1;
    }

    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 18px 18px 0 0;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(180deg); }
    }

    .form-title {
        position: relative;
        z-index: 2;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .form-field {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        position: relative;
    }

    .form-label::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 30px;
        height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 1px;
    }

    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: #fafafa;
        position: relative;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-1px);
    }

    .form-input:hover, .form-select:hover, .form-textarea:hover {
        border-color: #9ca3af;
        background: white;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .error-message::before {
        content: '⚠';
        font-size: 0.875rem;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        align-items: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }

    .btn-cancel {
        padding: 0.875rem 2rem;
        background: #f3f4f6;
        color: #6b7280;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
        color: #374151;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-submit {
        padding: 0.875rem 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    .form-icon {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .form-field:focus-within .form-icon {
        color: #667eea;
    }

    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        overflow: hidden;
    }

    .floating-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float-circle 8s infinite ease-in-out;
    }

    .floating-circle:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-circle:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .floating-circle:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }

    @keyframes float-circle {
        0%, 100% {
            transform: translateY(0px) scale(1);
            opacity: 0.7;
        }
        50% {
            transform: translateY(-20px) scale(1.1);
            opacity: 0.3;
        }
    }

    .progress-bar {
        height: 4px;
        background: #e5e7eb;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #667eea, #764ba2);
        width: 0%;
        transition: width 0.3s ease;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .button-group {
            flex-direction: column-reverse;
            gap: 0.75rem;
        }
        
        .btn-cancel, .btn-submit {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="form-container">
    <div class="floating-elements">
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
    </div>
    
    <div class="form-inner">
        <div class="form-header">
            <div class="form-title">
                <h2 class="text-2xl font-bold text-white mb-2">Tambah Santri Baru</h2>
                <p class="text-white text-opacity-90 text-sm">Lengkapi formulir di bawah untuk menambahkan data santri baru</p>
            </div>
        </div>

        <div class="p-8">
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill"></div>
            </div>

            <form action="{{ route('santri.store') }}" method="POST" id="santriForm">
                @csrf

                <div class="form-grid">
                    <div class="form-field">
                        <label for="nama" class="form-label">Nama Santri</label>
                        <div class="relative">
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" 
                                   class="form-input" required placeholder="Masukkan nama lengkap">
                            <svg class="form-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        @error('nama')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="nis" class="form-label">NIS</label>
                        <div class="relative">
                            <input type="number" name="nis" id="nis" value="{{ old('nis') }}" 
                                   class="form-input" required placeholder="Nomor Induk Santri">
                            <svg class="form-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                        </div>
                        @error('nis')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="kelas_id" class="form-label">Kelas</label>
                        <div class="relative">
                            <select name="kelas_id" id="kelas_id" class="form-select" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }} - {{ $k->tingkatan }}
                                    </option>
                                @endforeach
                            </select>
                            <svg class="form-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        @error('kelas_id')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="kamar_id" class="form-label">Kamar</label>
                        <div class="relative">
                            <select name="kamar_id" id="kamar_id" class="form-select" required>
                                <option value="">Pilih Kamar</option>
                                @foreach ($kamar as $k)
                                    <option value="{{ $k->id }}" {{ old('kamar_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kamar }}
                                    </option>
                                @endforeach
                            </select>
                            <svg class="form-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        @error('kamar_id')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <div class="relative">
                            <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}" 
                                   class="form-input" required>
                            <svg class="form-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @error('tgl_lahir')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-field" style="grid-column: 1 / -1;">
                        <label for="alamat_asal" class="form-label">Alamat Asal</label>
                        <div class="relative">
                            <textarea name="alamat_asal" id="alamat_asal" rows="4" 
                                      class="form-textarea" required placeholder="Masukkan alamat lengkap">{{ old('alamat_asal') }}</textarea>
                            <svg class="form-icon w-5 h-5" style="top: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        @error('alamat_asal')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="button-group">
                    <a href="{{ route('santri.index') }}" class="btn-cancel">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('santriForm');
    const progressFill = document.getElementById('progressFill');
    const requiredFields = form.querySelectorAll('[required]');
    
    function updateProgress() {
        let filledFields = 0;
        requiredFields.forEach(field => {
            if (field.value.trim() !== '') {
                filledFields++;
            }
        });
        
        const progress = (filledFields / requiredFields.length) * 100;
        progressFill.style.width = progress + '%';
    }
    
    requiredFields.forEach(field => {
        field.addEventListener('input', updateProgress);
        field.addEventListener('change', updateProgress);
    });
    
    // Initial progress update
    updateProgress();
    
    // Form submission confirmation
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = form.querySelector('.btn-submit');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Menyimpan...';
        submitBtn.disabled = true;
        
        // Simulate processing time for better UX
        setTimeout(() => {
            form.submit();
        }, 1000);
    });
});
</script>
@endsection