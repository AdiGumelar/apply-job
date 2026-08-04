<template>
    <main class="login-page">
        <section class="login-showcase" aria-label="Informasi aplikasi">
            <div class="login-brand">
                <span class="login-brand-mark">
                    <i class="bi bi-lightning-charge-fill"></i>
                </span>
                <span>
                    <strong>Dashboard</strong>
                    <small>Auto Apply</small>
                </span>
            </div>

            <div class="login-showcase-copy">
                <p class="section-label mb-3">AUTO APPLY PEKERJAAN</p>
                <h1>Kelola setiap peluang karier dalam satu tempat.</h1>
                <p>
                    Simpan dokumen, gunakan template terbaik, dan pantau seluruh proses lamaran Anda dengan lebih rapi.
                </p>
            </div>

            <div class="login-feature-list">
                <span><i class="bi bi-check2-circle"></i> Template lamaran siap pakai</span>
                <span><i class="bi bi-check2-circle"></i> Pantau status lamaran</span>
                <span><i class="bi bi-check2-circle"></i> Dokumen tersimpan aman</span>
            </div>
        </section>

        <section class="login-panel">
            <div class="login-card">
                <div class="login-card-heading">
                    <div class="login-mobile-brand">
                        <span class="login-brand-mark">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </span>
                    </div>
                    <p class="section-label mb-2">SELAMAT DATANG</p>
                    <h2>Masuk ke akun Anda</h2>
                    <p>Masukkan detail akun untuk melanjutkan proses apply pekerjaan.</p>
                </div>

                <form class="login-form">
                    <div>
                        <label for="email">Email</label>
                        <div class="login-input-wrap">
                            <i class="bi bi-envelope"></i>
                            <input id="email" type="email" placeholder="nama@email.com" autocomplete="email" />
                        </div>
                    </div>

                    <div>
                        <div class="login-label-row">
                            <label for="password">Password</label>
                            <a href="#">Lupa password?</a>
                        </div>
                        <div class="login-input-wrap">
                            <i class="bi bi-lock"></i>
                            <input id="password" type="password" placeholder="Masukkan password" autocomplete="current-password" />
                        </div>
                    </div>

                    <label class="login-remember">
                        <input type="checkbox" />
                        <span>Ingat saya</span>
                    </label>

                    <button type="button" class="login-submit">
                        Masuk
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                <div class="login-divider"><span>atau lanjutkan dengan</span></div>

                <button type="button" class="login-google-button">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#4285F4" d="M21.6 12.23c0-.71-.06-1.39-.18-2.05H12v3.88h5.38a4.6 4.6 0 0 1-1.99 3.01v2.51h3.23c1.89-1.74 2.98-4.31 2.98-7.35Z" />
                        <path fill="#34A853" d="M12 22c2.7 0 4.97-.9 6.62-2.42l-3.23-2.51c-.9.6-2.05.96-3.39.96-2.61 0-4.82-1.76-5.61-4.12H3.06v2.59A10 10 0 0 0 12 22Z" />
                        <path fill="#FBBC05" d="M6.39 13.91A6 6 0 0 1 6.08 12c0-.66.11-1.3.31-1.91V7.5H3.06A10 10 0 0 0 2 12c0 1.61.39 3.13 1.06 4.5l3.33-2.59Z" />
                        <path fill="#EA4335" d="M12 5.97c1.47 0 2.79.51 3.83 1.51l2.87-2.87C16.97 2.99 14.7 2 12 2a10 10 0 0 0-8.94 5.5l3.33 2.59C7.18 7.73 9.39 5.97 12 5.97Z" />
                    </svg>
                    Masuk dengan Google
                </button>

                <p class="login-register">Belum memiliki akun? <RouterLink to="/register">Daftar sekarang</RouterLink></p>
            </div>
        </section>
    </main>
</template>
