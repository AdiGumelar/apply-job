<template>
    <main class="register-page">
        <section class="register-showcase" aria-label="Informasi aplikasi">
            <div class="register-brand">
                <span class="register-brand-mark"><i class="bi bi-lightning-charge-fill"></i></span>
                <span><strong>Dashboard</strong><small>Auto Apply</small></span>
            </div>

            <div class="register-showcase-copy">
                <p class="section-label mb-3">MULAI PERJALANAN KARIER</p>
                <h1>Siapkan lamaran terbaik Anda mulai hari ini.</h1>
                <p>Buat akun untuk mengelola dokumen, template, dan setiap peluang pekerjaan secara lebih terarah.</p>
            </div>

            <div class="register-feature-list">
                <span><i class="bi bi-check2-circle"></i> Atur semua lamaran dalam satu dashboard</span>
                <span><i class="bi bi-check2-circle"></i> Gunakan template sesuai kebutuhan</span>
                <span><i class="bi bi-check2-circle"></i> Pantau progres karier Anda</span>
            </div>
        </section>

        <section class="register-panel">
            <div class="register-card">
                <div class="register-card-heading">
                    <div class="register-mobile-brand">
                        <span class="register-brand-mark"><i class="bi bi-lightning-charge-fill"></i></span>
                    </div>
                    <p class="section-label mb-2">BUAT AKUN</p>
                    <h2>Mulai lebih mudah</h2>
                    <p>Lengkapi data berikut untuk membuat akun Auto Apply Anda.</p>
                </div>

                <form class="register-form">
                    <div>
                        <label for="name">Nama lengkap</label>
                        <div class="register-input-wrap">
                            <i class="bi bi-person"></i>
                            <input id="name" type="text" placeholder="Masukkan nama lengkap" autocomplete="name" />
                        </div>
                    </div>

                    <div>
                        <label for="register-email">Email</label>
                        <div class="register-input-wrap">
                            <i class="bi bi-envelope"></i>
                            <input id="register-email" type="email" placeholder="nama@email.com" autocomplete="email" />
                        </div>
                    </div>

                    <div class="register-password-grid">
                        <div>
                            <label for="register-password">Password</label>
                            <div class="register-input-wrap">
                                <i class="bi bi-lock"></i>
                                <input id="register-password" type="password" placeholder="Minimal 8 karakter" autocomplete="new-password" />
                            </div>
                        </div>
                        <div>
                            <label for="password-confirmation">Konfirmasi password</label>
                            <div class="register-input-wrap">
                                <i class="bi bi-shield-lock"></i>
                                <input id="password-confirmation" type="password" placeholder="Ulangi password" autocomplete="new-password" />
                            </div>
                        </div>
                    </div>

                    <label class="register-terms">
                        <input type="checkbox" />
                        <span>Saya menyetujui <a href="#">syarat &amp; ketentuan</a> serta <a href="#">kebijakan privasi</a>.</span>
                    </label>

                    <button type="button" class="register-submit">
                        Buat akun
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                <div class="register-divider"><span>atau daftar dengan</span></div>

                <button type="button" class="register-google-button">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#4285F4" d="M21.6 12.23c0-.71-.06-1.39-.18-2.05H12v3.88h5.38a4.6 4.6 0 0 1-1.99 3.01v2.51h3.23c1.89-1.74 2.98-4.31 2.98-7.35Z" />
                        <path fill="#34A853" d="M12 22c2.7 0 4.97-.9 6.62-2.42l-3.23-2.51c-.9.6-2.05.96-3.39.96-2.61 0-4.82-1.76-5.61-4.12H3.06v2.59A10 10 0 0 0 12 22Z" />
                        <path fill="#FBBC05" d="M6.39 13.91A6 6 0 0 1 6.08 12c0-.66.11-1.3.31-1.91V7.5H3.06A10 10 0 0 0 2 12c0 1.61.39 3.13 1.06 4.5l3.33-2.59Z" />
                        <path fill="#EA4335" d="M12 5.97c1.47 0 2.79.51 3.83 1.51l2.87-2.87C16.97 2.99 14.7 2 12 2a10 10 0 0 0-8.94 5.5l3.33 2.59C7.18 7.73 9.39 5.97 12 5.97Z" />
                    </svg>
                    Daftar dengan Google
                </button>

                <p class="register-login">Sudah memiliki akun? <RouterLink to="/login">Masuk sekarang</RouterLink></p>
            </div>
        </section>
    </main>
</template>
