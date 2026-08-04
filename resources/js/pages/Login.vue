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

                <p class="login-register">Belum memiliki akun? <a href="#">Daftar sekarang</a></p>
            </div>
        </section>
    </main>
</template>

<style scoped>
.login-page { display: grid; grid-template-columns: minmax(0, 1.08fr) minmax(420px, .92fr); min-height: 100vh; background: var(--app-bg); }
.login-showcase { position: relative; display: flex; flex-direction: column; min-height: 100vh; padding: 42px clamp(36px, 7vw, 108px); overflow: hidden; color: #fff; background: linear-gradient(145deg, #1e293b 0%, #273b63 55%, #4f46e5 145%); }
.login-showcase::before, .login-showcase::after { position: absolute; border-radius: 999px; content: ""; pointer-events: none; }
.login-showcase::before { width: 460px; height: 460px; top: -215px; right: -150px; border: 76px solid rgba(129, 140, 248, .16); }
.login-showcase::after { width: 340px; height: 340px; bottom: -190px; left: -130px; background: rgba(79, 70, 229, .28); }
.login-brand { position: relative; z-index: 1; display: flex; align-items: center; gap: 12px; }
.login-brand-mark { display: inline-flex; align-items: center; justify-content: center; width: 46px; height: 46px; border-radius: 16px; background: var(--app-primary); color: #fff; font-size: 1.2rem; box-shadow: 0 12px 28px rgba(79, 70, 229, .35); }
.login-brand strong, .login-brand small { display: block; line-height: 1.2; }
.login-brand strong { font-size: 1rem; }
.login-brand small { margin-top: 3px; color: #cbd5e1; font-size: .78rem; font-weight: 500; }
.login-showcase-copy { position: relative; z-index: 1; max-width: 590px; margin: auto 0 42px; }
.login-showcase .section-label { color: #a5b4fc; }
.login-showcase h1 { max-width: 560px; margin: 0 0 20px; font-size: clamp(2.25rem, 4vw, 3.65rem); font-weight: 700; line-height: 1.15; letter-spacing: -.035em; }
.login-showcase-copy > p:last-child { max-width: 530px; margin: 0; color: #cbd5e1; font-size: 1rem; line-height: 1.8; }
.login-feature-list { position: relative; z-index: 1; display: grid; gap: 13px; color: #e2e8f0; font-size: .9rem; font-weight: 500; }
.login-feature-list span { display: inline-flex; align-items: center; gap: 9px; }
.login-feature-list i { color: #a5b4fc; font-size: 1.05rem; }
.login-panel { display: grid; place-items: center; padding: 36px; }
.login-card { width: min(100%, 430px); }
.login-card-heading h2 { margin: 0 0 10px; color: #0f172a; font-size: clamp(1.7rem, 3vw, 2.15rem); font-weight: 700; line-height: 1.2; }
.login-card-heading > p:last-child { margin: 0; color: var(--app-muted); font-size: .92rem; line-height: 1.65; }
.login-mobile-brand { display: none; margin-bottom: 28px; }
.login-form { display: grid; gap: 20px; margin-top: 32px; }
.login-form label { display: block; margin-bottom: 8px; color: var(--app-text); font-size: .85rem; font-weight: 700; }
.login-label-row { display: flex; justify-content: space-between; gap: 16px; }
.login-label-row a, .login-register a { color: var(--app-primary); font-weight: 700; text-decoration: none; }
.login-label-row a { font-size: .8rem; }
.login-input-wrap { position: relative; }
.login-input-wrap > i { position: absolute; top: 50%; left: 17px; color: var(--app-muted); transform: translateY(-50%); }
.login-input-wrap input { width: 100%; height: 52px; padding: 0 16px 0 47px; border: 1px solid var(--app-border); border-radius: 16px; outline: 0; background: #f8fafc; color: var(--app-text); font-size: .9rem; transition: border-color .2s ease, box-shadow .2s ease, background .2s ease; }
.login-input-wrap input::placeholder { color: #94a3b8; }
.login-input-wrap input:focus { border-color: var(--app-primary); background: #fff; box-shadow: 0 0 0 .22rem rgba(79, 70, 229, .12); }
.login-remember { display: inline-flex !important; align-items: center; gap: 9px; width: fit-content; margin: -4px 0 0 !important; cursor: pointer; color: var(--app-muted) !important; font-size: .84rem !important; font-weight: 500 !important; }
.login-remember input { width: 16px; height: 16px; margin: 0; accent-color: var(--app-primary); }
.login-submit, .login-google-button { display: inline-flex; align-items: center; justify-content: center; gap: 10px; min-height: 52px; border-radius: 16px; font-size: .9rem; font-weight: 700; transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease; }
.login-submit { border: 1px solid var(--app-primary); background: var(--app-primary); color: #fff; box-shadow: 0 14px 26px rgba(79, 70, 229, .25); }
.login-submit:hover { transform: translateY(-2px); background: #4338ca; box-shadow: 0 18px 30px rgba(79, 70, 229, .3); }
.login-divider { display: flex; align-items: center; gap: 14px; margin: 27px 0; color: #94a3b8; font-size: .76rem; font-weight: 600; }
.login-divider::before, .login-divider::after { height: 1px; flex: 1; background: var(--app-border); content: ""; }
.login-google-button { width: 100%; border: 1px solid var(--app-border); background: #fff; color: var(--app-text); }
.login-google-button:hover { border-color: #cbd5e1; transform: translateY(-2px); box-shadow: var(--app-shadow-soft); }
.login-google-button svg { width: 19px; height: 19px; }
.login-register { margin: 28px 0 0; color: var(--app-muted); font-size: .84rem; text-align: center; }
@media (max-width: 991.98px) { .login-page { grid-template-columns: 1fr; } .login-showcase { min-height: auto; padding: 28px 36px 32px; } .login-showcase-copy, .login-feature-list { display: none; } .login-panel { min-height: calc(100vh - 106px); } }
@media (max-width: 575.98px) { .login-showcase { padding: 24px; } .login-brand { display: none; } .login-panel { min-height: 100vh; padding: 28px 22px; } .login-mobile-brand { display: block; } .login-card { max-width: 100%; } }
</style>
