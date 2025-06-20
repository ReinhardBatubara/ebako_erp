<h4>Direct Labor</h4>
<div style="width: 99.5%;margin-left: 2px">
    <div align="left" style="margin-top: 5px;margin-bottom: 5px;">
        <form id="search_form" onsubmit="directlabour_search(0); return false;">
            <span class="labelelement">Description</span>
            <input type="text" name="description" />
            <button type="submit">Search</button>
            <?php if (in_array('add', $accessmenu)) { ?>
                <button type="button" onclick="directlabour_add()">Add</button>
            <?php } ?>
        </form>
    </div>
    <div id="groupsdata" style="width:50%">
    <?php
    // Kumpulkan kembali semua variabel yang dibutuhkan oleh search.php
    $search_data = array(
        'directlabor'  => $directlabor,
        'accessmenu' => $accessmenu,
        'num_rows'   => $num_rows,
        'page'       => $page,
        'num_page'   => $num_page,
        'first'      => $first,
        'prev'       => $prev,
        'next'       => $next,
        'last'       => $last
    );
    $this->load->view('directlabour/search', $search_data);
    ?>
</div>
</div>

<script>
// Pastikan jQuery sudah di-load di halaman utama Anda (misal: home.php)

function directlabour_search(offset) {
    // Menampilkan loading
    $("#groupsdata").html("<p>Loading...</p>");
    $.ajax({
        url: "<?php echo site_url('directlabour/search'); ?>/" + offset,
        type: 'POST',
        data: $('#search_form').serialize(), // Mengirim data form
        success: function(response) {
            $('#groupsdata').html(response); // Menampilkan tabel baru
        },
        error: function() {
            $('#groupsdata').html("<p>Error loading data.</p>");
        }
    });
}

// Fungsi untuk pindah ke halaman add
function directlabour_add() {
    window.location.href = "<?php echo site_url('directlabour/add'); ?>";
}

// Fungsi untuk pindah ke halaman edit
function directlabour_edit(id) {
    window.location.href = "<?php echo site_url('directlabour/edit'); ?>/" + id;
}

// Fungsi untuk menghapus data
function directlabour_delete(id) {
    if (confirm('Are you sure you want to delete this data?')) {
        window.location.href = "<?php echo site_url('directlabour/delete'); ?>/" + id;
    }
}

// Menangani klik pada link paginasi secara dinamis
$(document).on('click', '.pagination a', function(event) {
    event.preventDefault(); // Mencegah link berpindah halaman secara normal
    var href = $(this).attr('href');
    var offset = href.split('/').pop(); // Mengambil angka offset dari akhir URL
    if ($.isNumeric(offset)) {
        directlabour_search(offset);
    }
});
</script>