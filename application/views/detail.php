<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo base_url(); ?>assets/template/plugins/dataTables/datatables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/templatep/plugins/dataTables/responsive.dataTables.min.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>assets/templatep/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/templatep/ckeditor/ckeditor.js"></script>

    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templatep/sweetalert/dist/sweetalert2.min.css">
    <script src="<?php echo base_url(); ?>assets/templatep/sweetalert/dist/sweetalert2.min.js"></script>
</head>

<!-- <body oncontextmenu="return false"> -->

<body>
    <header class="container d-flex flex-wrap justify-content-center py-3 mt-2 mb-4 border-bottom bg-dark shadow p-3 rounded">
        <a href="<?php echo base_url(); ?>" class="d-flex align-items-center me-md-auto text-decoration-none">
            <span class="fs-4 ms-md-4 text-decoration-none text-light">Header</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="<?php echo base_url(); ?>" class="nav-link active" aria-current="page">Home</a></li>
        </ul>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="bg-tertiary rounded shadow mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="mt-2 mb-3">
                                Data Pendaftar
                                <!-- <img src="" alt="" height="100" width="100" id="imageku">
                                <div id="heheh">hahahah</div>
                                <iframe id="frameDokumen" frameborder="0" style="width: 100%;height:500px;"></iframe>
                                <iframe id="haha" frameborder="0" style="width: 100%;height:500px;"></iframe>
                                <button formtarget="_blank" onclick="pdf()">Download as PDF</button> -->
                            </h2>
                        </div>
                    </div>
                    <div class="row row-cols-3 g-3 mb-3" id="place-for-data">
                        <div class="col">

                            <?php echo $arr ? $arr['nama'] : ''; ?>
                            <?php echo $arr ? $arr['nip'] : ''; ?>
                        </div>
                    </div>
                    <div class="row row-cols-3 g-3 mb-3" id="place-for-data">
                        <div class="col">
                            <h3 class="mt-2 mb-3">
                                Data Atribut Pendaftar
                            </h3>
                            <table id="data_atribut" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Jenis Atribut</th>
                                        <th scope="col">Value</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Hapus?</h5>
                    <p class="mb-0">Anda tidak bisa mengembalikan data yang telah dihapus</p>
                    <input type="hidden" id="id_hapus">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end btn-danger" onclick="hapus_data()"><strong>Ya, hapus</strong></button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/js/popper.js"></script>


    <script src="<?php echo base_url(); ?>assets/templatep/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/templatep/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/templatep/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/templatep/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/templatep/plugins/dataTables/datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/templatep/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/templatep/plugins/dataTables/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/templatep/js/table-manage-default.demo.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/templatep/plugins/gritter/js/jquery.gritter.js"></script>
    <script src="<?php echo base_url(); ?>assets/templatep/plugins/bootstrap-sweetalert/sweetalert.js"></script>
    <script src="<?php echo base_url(); ?>assets/templatep/js/jquery.PrintArea.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#data_atribut').DataTable({
                "processing": true,
                "serverSide": true,
                "bSort": false,
                "bInfo": false,
                "searching": false,
                "paging": false,
                "ajax": {
                    "url": "<?php echo base_url('main/get_atribut/') . $arr['id'] ?>",
                    "type": "POST"
                }
            });
        });

        // function show_images() {

        // }

        // function show_modal(id) {
        //     document.getElementById("id_hapus").value = id;
        // }

        // function edit_data_page(id) {
        //     window.location.href = '<?php echo base_url() ?>' + 'main/form_data/' + id;
        // }

        // // function get_data() {
        // //     var xhttp = new XMLHttpRequest;
        // //     xhttp.onreadystatechange = function() {
        // //         if (this.readyState == XMLHttpRequest.DONE) {
        // //             if (xhttp.status == 200) {
        // //                 document.getElementById("place-for-data").innerHTML = xhttp.responseText;
        // //                 console.log('Berhasil');
        // //             } else {
        // //                 console.log('Gagal');
        // //             }

        // //         }
        // //     }

        // //     xhttp.open('GET', '<?php echo base_url() ?>/main/get_json', true);
        // //     xhttp.send();
        // // }

        // function hapus_data() {
        //     let data = 'id=' + document.getElementById('id_hapus').value;

        //     var xhttp = new XMLHttpRequest;
        //     xhttp.open("POST", "<?php echo base_url() ?>main/delete_json/", false);
        //     xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        //     xhttp.onreadystatechange = function() {
        //         if (this.readyState == XMLHttpRequest.DONE) {
        //             if (xhttp.status == 200) {
        //                 console.log(xhttp.responseText);
        //             } else {
        //                 console.log(xhttp.responseText);
        //             }

        //         }
        //     }
        //     xhttp.send(data);
        //     location.reload();
        // }

        // function pdf() {
        //     var xhttp = new XMLHttpRequest;
        //     xhttp.open('GET', '<?php echo base_url() ?>/main/pdf', true);
        //     xhttp.onreadystatechange = function() {
        //         if (this.readyState == XMLHttpRequest.DONE) {
        //             if (xhttp.status == 200) {
        //                 document.getElementById("haha").src = xhttp.response;
        //                 console.log('Berhasilyeay');
        //             } else {
        //                 console.log('Gagalyeay');
        //             }

        //         }
        //     }

        //     xhttp.send();
        // }

        // function lihatDokumen() {
        //     // $('#modal-lihat-dokumen').modal({
        //     //     show: true,
        //     //     backdrop: 'static'
        //     // });
        //     document.getElementById("frameDokumen").src = 'https://www.pn-bengkulu.go.id/upload/document_pn/LAMPIRAN%20III.pdf';

        // }

        // window.onload = [
        //     pdf(),
        //     show_images(),
        //     //get_data(),
        //     lihatDokumen()
        // ];
    </script>
</body>

</html>