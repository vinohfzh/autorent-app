<section>
    <header>
        <h2 class="fw-bold fs-4 text-danger mb-1">
            Hapus Akun
        </h2>
        <p class="text-muted small">
            Setelah akun Anda dihapus, semua data dan riwayat penyewaan akan hilang secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi yang ingin Anda simpan.
        </p>
    </header>

    <button type="button" class="btn btn-outline-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        Hapus Akun
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('delete')

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="confirmUserDeletionModalLabel">Apakah Anda yakin ingin menghapus akun?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-3">
                        Tindakan ini tidak dapat dibatalkan. Masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label small fw-medium visually-hidden">Password</label>
                        <input id="password" name="password" type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Password" required>
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</section>

@if($errors->userDeletion->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
            myModal.show();
        });
    </script>
@endif
