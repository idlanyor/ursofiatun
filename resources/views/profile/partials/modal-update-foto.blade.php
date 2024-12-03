<div class="modal fade " data-bs-backdrop="static" data-bs-keyboard="false" id="updateFotoModal" tabindex="-1"
    aria-labelledby="updateFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="updateFotoForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateFotoModalLabel">Update foto profil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
                            @if (Auth::user()->foto_profil === null)
                                <img id="fotoPreview"
                                    src="https://api.dicebear.com/9.x/adventurer-neutral/svg?seed={{ Auth::user()->nama }}"
                                    class="rounded-circle" width="200" height="200">
                            @else
                                <img id="fotoPreview" src="{{ asset(Auth::user()->foto_profil) }}" alt="avatar"
                                    class="rounded-circle" width="200" height="200">
                            @endif

                        </div>
                        <div class="col-md-8 col-sm-12 mt-3">
                            <ul class="list-group">
                                <li class="list-group-item">Untuk hasil yang lebih baik, pastikan rasio foto 1:1 (
                                    persegi )
                                </li>
                                <li class="list-group-item">Ekstensi foto yang didukung : <code>JPG,JPEG,PNG,SVG,dan
                                        GIF</code></li>
                                <li class="list-group-item">Untuk menunjang Estetika profil, harap mengupload foto yang
                                    jernih/tidak buram</li>
                                <li class="list-group-item">Klik tombol dibawah ini untuk mengganti foto profil</li>
                            </ul>
                            <div class="input-group mt-3">
                                <input type="file" id="fotoInput" name="foto"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateFotoForm = document.getElementById('updateFotoForm');
            const fotoInput = document.getElementById('fotoInput');
            const fotoPreview = document.getElementById('fotoPreview');
            const updateFotoModal = new bootstrap.Modal(document.getElementById('updateFotoModal'));
            // handle preview
            fotoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    // Validasi tipe file jika diperlukan
                    if (!file.type.startsWith('image/')) {
                        toastr.warning('Harap pilih file gambar!');
                        return;
                    }

                    const previewUrl = URL.createObjectURL(file);
                    fotoPreview.src = previewUrl;

                    fotoPreview.onload = () => URL.revokeObjectURL(previewUrl);
                }
            });
            // handle upload
            updateFotoForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                axios.post('{{ route('update-foto') }}', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'X-HTTP-Method-Override': 'PUT'

                        }
                    })
                    .then(response => {
                        toastr.success('Foto profil berhasil diperbarui!');
                        window.location.reload();
                    })
                    .catch(error => {
                        toastr.error(error);
                    });
            });
        });
    </script>
@endpush
