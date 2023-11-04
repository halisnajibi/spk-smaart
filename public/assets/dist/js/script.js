

//notif success
const dataModal = $("#success-modal-preview").data("modal");
if (dataModal == 1) {
    $("#success-modal-preview").modal("show");
}
//notif error
const dataModalErr = $("#warning-modal-preview").data("modal");
if (dataModalErr == 1) {
    $("#warning-modal-preview").modal("show");
}

//konfirmasi hapus
function konfirmasiHapus(url, id) {
    $("#delete-modal-preview").modal("show");
    $("#form-hapus").attr("action", url + id);
}

//kriteria  berdasarkan tahun keputusan
// $(document).ready(function() {
//     $("#kriteria-tahun").on("change", function() {
//         const nilaiOpsi = $(this).val();
//       $.ajax({
//             url:'/kriteria',
//             type:'get',
//             data:{
//                 idTahun:nilaiOpsi
//             },
//             success:function(response){
//                 $("#tabel-kriteria").html(response);
//             }
//       })
//     });
// });

//modal tahun
// $(document).ready(function(){
//     $('#btnTambah').on('click',function(e){
//         e.preventDefault();
//         $('#basic-modal-preview').removeClass('hidden');
//     })
// })

//nested penilaian
$(document).ready(function() {
    $("#tahun_keputusan_penilaian").on("change", function() {
        const nilaiOpsi = $(this).val();
      $.ajax({
            url:'/penilaian/select/nested',
            type:'get',
            data:{
                idTahun:nilaiOpsi
            },
            success:function(response){
               const alternatif = $('#alternatif');
               const alternatifBox = $('#alternatif-box')
               alternatif.empty();
               alternatifBox.empty()
               console.log(response)
               if(response.alternatif[0].status_alternatif == 'manusia'){
               $.each(response.alternatif, function(i, row) {
                    const optionHTML = '<option value="' + row.id + '">' + row.nama + '</option>';
                    alternatif.append(optionHTML);
                
                });
               }else{
                $.each(response.alternatif, function(i, row) {
                    const optionHTML = '<option value="' + row.id + '">' + row.judul + '</option>';
                    alternatif.append(optionHTML);
                
                });
               }
               

                $.each(response.kriteria,function(i,row){
                    const input =`<div class="mb-3">
                    <input type="hidden" name="kriteria_id[]" value="`+row.id+`">
                    <label class="flex flex-col sm:flex-row" for="">`+row.nama_kriteria+`<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required</span></label>
                    <input type="text" name="nilai[]" class="input w-full border mt-2"
                        placeholder="10-99" minlength="2">
                   
                </div>`
                alternatifBox.append(input);
                })
            }
      })
    });
});

//penilaian alternatif berdasarkan tahun keputusan
$(document).ready(function() {
    $("#penilaian-tahun").on("change", function() {
        const nilaiOpsi = $(this).val();
        alert(nilaiOpsi)
    });
});


// simpan riwayat perangkingan
$(document).ready(function() {
    $("#simpan-riwayat").on("click", function() {
     const tahunID =$('#tahunID').val()
     const karyawanID =$('#karyawanID').val()
     const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url:'/perangkingan/simpan-riwayat-perangkingan',
        type:'post',
        data:{
            _token: csrfToken,
            tahunId:tahunID,
            karyawanId:karyawanID
        },
        success:function(response){
            alert('data disimpan')
        }
    })
    });
});

