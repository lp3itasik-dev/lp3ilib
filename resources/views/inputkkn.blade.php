<x-landing-layout>
    <div class="container mx-auto mt-14">
        <div>
            <div class="px-4 text-center items-center">
                <p class="font-bold text-black text-xl md:text-2xl mb-5">Upload Laporan KKN</p>
            </div>
            <section id="inputrepo" class="px-4">
                <div class="container mx-auto">
                    <div class="w-full mx-auto px-6 py-6 mb-10 shadow-lg bg-white rounded-2xl border">
                        <form method="POST" enctype="multipart/form-data" id="uploadForm"
                            action="{{ route('inputkkn.store') }}" onsubmit="return uploadBerkas(event)">
                            @csrf
                            <button id="addRowBtn" class="mb-3 bg-sky-500 p-2 rounded-xl m-4 text-black">Tambah
                                Mahasiswa</button>

                            <div class="relative overflow-x-auto mb-6">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                    id="candidat-datatable">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th class="w-5">No.</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>NIM</th>
                                            <th>Program Studi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Dynamic rows will be added here -->
                                    </tbody>
                                </table>
                            </div>

                            <input type="hidden" id="series" name="series" value="{{ date('YmdHis') }}">

                            <div class="mb-6 mt-6">
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                <input type="text" id="title" name="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="isi dengan judul...">
                            </div>

                            <div class="flex w-full gap-4">
                                <div class="mb-6 w-full">
                                    <label for="nama_kelompok"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelompok</label>
                                    <input type="text" id="nama_kelompok" name="nama_kelompok"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="isi dengan nama kelompok...">
                                </div>

                                <div class="mb-6 w-full">
                                    <label for="tahun_angkatan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun
                                        Angkatan</label>
                                    <input type="number" id="tahun_angkatan" name="tahun_angkatan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="isi dengan tahun angkatan...">
                                </div>

                                <div class="mb-6 w-full">
                                    <label for="lecturer"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DPL</label>
                                    <select id="lecturer" name="lecturer" data-placeholder="Pilih Pembimbing"
                                        class="js-example-basic-single bg-gray-50 border border-gray-300 py-6 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Pilih Pembimbing...</option>
                                        @foreach ($users as $u)
                                            <option value="{{ $u->identity }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="file_input">Upload file</label>
                                <input
                                    class="block w-full text-sm p-2 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="file_input_help" id="files" name="files" type="file">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PDF (MAX.
                                    10Mb).</p>
                            </div>

                            <div class="flex flex-row justify-center">
                                <button type="submit"
                                    class="text-white mx-auto shadow-lg bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-16 py-3 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Upload <i class="fa-solid fa-upload ml-5"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="w-full">
        @include('components.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        let rowCount = 0;

        document.getElementById('addRowBtn').addEventListener('click', function(e) {
            e.preventDefault();
            addRow();
        });

        function addRow() {
            const tableBody = document.querySelector('#candidat-datatable tbody');
            const currentRowCount = tableBody.rows.length;

            if (currentRowCount >= 15) {
                alert('You cannot add more than 15 rows.');
                return;
            }

            rowCount++;
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>${rowCount}</td>
                <td><input type="text" name="nama_mahasiswa[]" id="nama_mahasiswa${rowCount}" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg"></td>
                <td><input type="text" name="nim[]" id="nim${rowCount}" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg"></td>
                <td>
                    <select id="program_studi${rowCount}" name="program_studi[]" class="w-full js-example-placeholder-single js-states bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" data-placeholder="Pilih Mahasiswa">
                        <option value="">Pilih...</option>
                        <option value="Manajemen Keuangan Perbankan">Manajemen Keuangan Perbankan</option>
                        <option value="Manajemen Pemasaran">Manajemen Pemasaran</option>
                        <option value="Manajemen Informatika">Manajemen Informatika</option>
                        <option value="Administrasi Bisnis">Administrasi Bisnis</option>
                    </select>
                </td>
                <td><button type="button" class="removeRowBtn bg-red-500 text-white p-2 rounded" onclick="removeRow(${rowCount})">Hapus</button></td>
            `;

            tableBody.appendChild(newRow);

            $(`#program_studi${rowCount}`).select2({
                placeholder: "Pilih Mahasiswa"
            });

            updateRowNumbers();
        }

        function updateRowNumbers() {
            const rows = document.querySelectorAll('#candidat-datatable tbody tr');
            rows.forEach((row, index) => {
                row.cells[0].textContent = index + 1;
            });
        }

        function removeRow(rowNumber) {
            document.getElementById(`program_studi${rowNumber}`).closest('tr').remove();
            updateRowNumbers();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(".js-example-placeholder-single").select2({
            placeholder: "Pilih...",
            allowClear: true
        });
    </script>

    @push('scripts')
        <script>
            const uploadBerkas = async (event) => {
                event.preventDefault();
                showLoading();
                let success = false;

                try {
                    let timestamp = new Date();
                    let identity = "KKN";
                    let type = 2;
                    let title = document.getElementById('title').value;
                    let abstract = "-";
                    let lecturer = document.getElementById('lecturer').value;
                    let series = document.getElementById('series').value;
                    let nama_kelompok = document.getElementById('nama_kelompok').value;
                    let nama_mahasiswa = Array.from(document.querySelectorAll('input[name="nama_mahasiswa[]"]')).map(
                        input => input.value);
                    let nim = Array.from(document.querySelectorAll('input[name="nim[]"]')).map(input => input.value);
                    let program_studi = Array.from(document.querySelectorAll('input[name="program_studi[]"]')).map(
                        input => input.value);
                    let tahun_angkatan = document.getElementById('tahun_angkatan').value;

                    let fileInput = document.getElementById('files');

                    if (fileInput.files.length === 0) {
                        alert('Tidak ada file yang dipilih.');
                        hideLoading();
                        return false;
                    }

                    let file = fileInput.files[0];
                    let konfirmasi = confirm(`Apakah Anda yakin akan mengunggah berkas ${file.name}`);

                    if (!konfirmasi) {
                        hideLoading();
                        return false;
                    }

                    let data = {
                        series: series,
                        file_name: `${identity}-${type}-${series}`,
                        typefile: `.${file.name.split('.').pop()}`,
                        title: title,
                        abstract: abstract,
                        lecturer: lecturer,
                        type: type,
                        nama_kelompok: nama_kelompok,
                        nama_mahasiswa: nama_mahasiswa,
                        nim: nim,
                        student:identity,
                        program_studi: program_studi,
                        tahun_angkatan: tahun_angkatan
                    };

                    const responseDatabase = await axios.post('/detailrepo', data, {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Content-Type': 'application/json',
                        }
                    });

                    if (responseDatabase.data.detail_repo.id) {
                        const reader = new FileReader();

                        reader.onload = async (event) => {
                            try {
                                let repository = {
                                    identity: identity,
                                    type: type,
                                    series: series,
                                    id: responseDatabase.data.detail_repo.id,
                                    typefile: file.name.split('.').pop(),
                                    file: event.target.result.split(';base64,').pop(),
                                };

                                const responseUpload = await axios.post(
                                    'https://uploadhub-repository.politekniklp3i-tasikmalaya.ac.id/upload',
                                    repository,
                                );

                                alert(responseUpload.data.message);
                                hideLoading();
                                location.reload();
                                success = true;
                                document.getElementById("uploadForm").action = "{{ route('inputkkn.store') }}";
                                document.getElementById("uploadForm").submit();
                            } catch (uploadError) {
                                alert('MOHON MAAF, SERVER SEDANG TIDAK TERSEDIA 1');
                                console.error(uploadError);
                                hideLoading();
                            }
                        };

                        reader.readAsDataURL(file);
                    }
                } catch (error) {
                    alert('MOHON MAAF, SERVER SEDANG TIDAK TERSEDIA 2');
                    console.error(error);
                    hideLoading();
                } finally {
                    return success; // Return the success flag
                }
            };
        </script>
    @endpush

</x-landing-layout>
