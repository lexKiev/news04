<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">Copyright &copy; Your Website 2018</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{asset('user/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Custom scripts for this template -->
<script src="{{asset('user/js/clean-blog.min.js')}}"></script>
<script src="{{asset('user/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('user/js/app.js')}}"></script>

{{--slider control--}}
<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            loop:true,
            margin:10,
            dots:false,
            autoplay:true,
            autoplayTimeout:5000,
            // nav:true,
            responsive:{
                270:{
                    items:1,
                },
                400:{
                    items:3,
                    margin:5
                },
                600:{
                    items:4,
                    margin:10
                },
                1000:{
                    items:5
                },
                1200:{
                    items:6
                },
                1400:{
                    items:7
                }
                ,
                1600:{
                    items:8
                }
                ,
                1800:{
                    items:10
                }
                ,
                2000:{
                    items:12
                }
            },
            autoHeight:false
        })
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">


    $('.itemName').select2({
        placeholder: 'Search By Tag',
        ajax: {
            url: '/select2-autocomplete-ajax',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.name,
                            slug: item.slug,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('.itemName').on('select2:select', function (e) {
        var data = e.params.data;

        window.location.href = '/articles/tag/'+data.slug;
    });

</script>
@section('footerSection')
@show
