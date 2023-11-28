@extends('layouts.app')

@section('content')

<script async src="{{ env('GOOGLE_MAPS_API_KEY') }}">
</script>


<style>
    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
        flex-basis: 0;
        flex-grow: 4;
    }

    #mapConfirm {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
        flex-basis: 0;
        flex-grow: 4;
    }

    #sidebar {
        flex-basis: 15rem;
        flex-grow: 1;
        padding: 1rem;
        max-width: 30rem;
        height: 100%;
        box-sizing: border-box;
        overflow: auto;
        width: 100%;
    }

    .center {
        margin: auto;
        width: 50%;
        /* border: 3px solid green; */
        padding: 10px;
        margin-top: 150px;
    }
</style>



<main class="my-8">
    <div class="container px-6 mx-auto">

        <div class="flex justify-center my-6">

            <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/cart') }}">Cart</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ol>
                    <h3 class="text-3xl text-bold">Checkout</h3>
                </nav>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subharga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($cartItems as $item)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->quantity * $item->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mb-2">Total Harga Belanjaan dikeranjang: Rp.{{ Cart::getTotal() }}</div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nama" name="nama_user"
                            value="{{ Auth::User()->name }}" aria-label="First name" disabled>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nomor Whatsapp" aria-label="Last name">
                    </div>
                    <!-- <div class="col">
                        <input type="text" class="form-control" placeholder="Ongkir" id="ongkir" disabled>
                    </div> -->

                    <input type="hidden" class="form-control" id="latConfirm" placeholder="lat" value="0">

                    <input type="hidden" class="form-control" id="lngConfirm" placeholder="lng" value="0">
                    <div class="col">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#checkoutModal">Lokasi Saya</button>
                    </div>
                    <div class="container mt-3"></div>
                    <div id="mapConfirm">
                        <div class="text-center">
                            <h3 class="center" style="color: red;" id="confirm"></h3>
                        </div>
                    </div>
                    <div class="alert alert-warning mt-3" role="alert">
                        <p><span id="total_jarak"></span></p>
                        <p><span id="Total_ongkir"></span></p>
                        <b>
                            <p><span id="Total"></span></p>
                        </b>
                    </div>

                </div>
                <div class="mt-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1"
                        placeholder="Tuliskan Alamat yang menjadi ciri-ciri lengkap rumah anda !" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-outline-success mt-3">Checkout</button>

            </div>

        </div>
    </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="map"></div>

                <input class="form-control" type="hidden" id="lat" name="lat">
                <input class="form-control" type="hidden" id="lng" name="lng">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal"
                    onclick="initMapConfim()">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script>


    const lat = document.getElementById("latConfirm").value;

    // MapBeforeConfirm
    function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
        });

        const marker = new google.maps.Marker({
            position: null, // tanpa nilai awal
            map: map,
            title: 'Click to zoom',
            draggable: true
        });

        var infowindow = new google.maps.InfoWindow({
            content: "<h6>Drag untuk pindah lokasi</h6>",
        });

        infowindow.open(map, marker);

        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);

        // Atur nilai input pada dokumen siap
        document.getElementById('lat').value = "";
        document.getElementById('lng').value = "";

        // Panggil getInitialLocation untuk mendapatkan lokasi pengguna
        getInitialLocation(map, marker, infowindow);
    }

    function handleEvent(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
    }

    function getInitialLocation(map, marker, infowindow) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLatLng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                marker.setPosition(userLatLng);
                map.setCenter(userLatLng);

                infowindow.setContent("Lokasi Anda");
                infowindow.open(map, marker);

                // Atur nilai input saat lokasi awal diperoleh
                document.getElementById('lat').value = userLatLng.lat;
                document.getElementById('lng').value = userLatLng.lng;
            }, function (error) {
                console.error('Error getting user location:', error);
            });
        } else {
            console.error('Geolocation is not supported by this browser.');
        }
    }





    // Map Confirm
    // Pelajarin mapConfirm buat agar Destination Atau Origin berganti Ketika save Changes ditekan,(Proses ini dilakukan agar posis Setelah confirmasi kelihatan ongkir, dan kelihatan rute, dari Pembeli ke toko !)
    function initMapConfim() {
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();

        const map = new google.maps.Map(document.getElementById("mapConfirm"), {
            zoom: 15,
            center: {
                lat: 0.385756,
                lng: 109.959209,
            },
        });

        directionsRenderer.setMap(map);

        document.getElementById("latConfirm").value = document.getElementById("lat").value;
        document.getElementById("lngConfirm").value = document.getElementById("lng").value;
        calculateAndDisplayRoute(directionsService, directionsRenderer);
    }




    function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        const endLocation = {
            lat: parseFloat(document.getElementById("latConfirm").value),
            lng: parseFloat(document.getElementById("lngConfirm").value),
        };

        const startLocation = {
            lat: 0.385756,
            lng: 109.959209,
        };

        directionsService
            .route({
                origin: startLocation,
                destination: endLocation,
                travelMode: google.maps.TravelMode.DRIVING,
            })
            .then((response) => {
                directionsRenderer.setDirections(response);

                // Calculate total distance in kilometers
                const totalDistance = calculateTotalDistance(response);

                // Assuming the price per kilometer is 3000
                const pricePerKilometer = 5000;

                // Calculate total price
                const totalPrice = totalDistance * pricePerKilometer;

                // Display total distance and total price
                displayTotal(totalDistance, totalPrice);
            })
            .catch((e) => window.alert("Directions request failed due to " + status));
    }

    function calculateTotalDistance(directionsResult) {
        let totalDistance = 0;
        const legs = directionsResult.routes[0].legs;

        for (let i = 0; i < legs.length; i++) {
            totalDistance += legs[i].distance.value;
        }

        // Convert total distance from meters to kilometers
        totalDistance = totalDistance / 1000;

        // Display total distance
        document.getElementById("total_jarak").innerText = `${totalDistance} km`;

        return totalDistance;
    }

    function displayTotal(totalDistance, totalPrice) {
        const cartTotal = parseFloat("{{ Cart::getTotal() }}");
        const rawTotal = totalPrice + cartTotal;

        // Menggenapkan ke atas ke kelipatan 500
        const roundedTotal = Math.ceil(rawTotal / 500) * 500;

        document.getElementById("Total_ongkir").innerText = `Total Ongkir : Rp.${numberWithCommas(totalPrice)}`;
        document.getElementById("total_jarak").innerText = `Total Jarak :${totalDistance} km`;

        // Menampilkan total pembayaran yang dihasilkan dengan titik dan koma
        document.getElementById("Total").innerText = `Total Seluruh Bayaran : Rp.${numberWithCommas(roundedTotal)}`;
    }

    // Fungsi untuk menambahkan titik dan koma pada angka
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }









    // Pemanggilan fungsi initMap dari HTML
    document.addEventListener('DOMContentLoaded', function () {
        initMap();
        if (lat == 0) {
            // console.log("masih kosong")
            document.getElementById("confirm").innerHTML = "Anda Belum memilih Lokasi!"
        } else {
            initMapConfim();
        }
    });
</script>




<!-- https://developers.google.com/maps/documentation/javascript/directions?hl=id -->






@endsection