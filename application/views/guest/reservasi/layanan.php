<section class="faculty-area section-gap">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="wow fadeIn" data-wow-duration="1s">
                    <p>
                        <h1>Form Pilih Layanan</h1>
                    </p>
                    
                    <form method="POST" action="<?= base_url('reservasi/create') ?>">
                    <div id="content">
               </div>
                        <div class="card mt-2">
                            <div class="card-header">
                                Quote
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var base_url = "<?= base_url() ?>";

    $(function(){
        load(1);
    });

    function searchByText(collection, text, exclude) {
        return _.filter(collection, _.flow(
            _.partial(_.omit, _, exclude),
            _.partial(
            _.some, _,
            _.flow(_.toLower, _.partial(_.includes, _, _.toLower(text), 0))
            )
        ));
    }


    function load(tag){
        $.ajax({
            url : "<?= base_url('layanan/getAll') ?>",
            type:"GET",
            dataType:"JSON",
            success:function(res){
                console.log(res);
            }
        });
    }
</script>