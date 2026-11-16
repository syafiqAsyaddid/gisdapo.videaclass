<x-layout-kcd>
    <style type="text/css">
	.container input[type="submit"], .back{
		padding: 15px 30px;
		float: right;
	}
	.invalid{
		/* background: rgba(255, 25, 60, 0.4); */
		color: red;
		padding: 5px;
		border-radius: 10px;
		margin-top: 5px;
		text-transform: uppercase;
		font-size: 14px;
	}
	</style>
	{{-- <form method="post" action="/kcd/kecamatan/import" enctype="multipart/form-data">
			@csrf
			<div class="input-group" style="float: left; width: 400px;">
					<input required type="file" class="form-control" id="inputGroupFile04"
							aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="excel">
					<button class="btn btn-outline-secondary" type="submit"
							id="inputGroupFileAddon04">Submit</button>
			</div>
	</form> --}}
	<div class="container-fluid bg-light">
		<div class="row flex-column-reverse flex-sm-row">
			<div class="col-sm-4"></div>
			<div class="col-sm-12">
				<div class="container-index">
						@include('map.map')
				</div> 
			</div>
		</div>
	</div>
    <script>
        // Inject Admin Context and Lookup Map
        var isAdmin = true;
        var kecamatanMap = {
            @foreach($kecamatan as $kec)
                "{{ strtoupper($kec->nama_kecamatan) }}": {{ $kec->id }},
            @endforeach
        };

        $(document).ready(function(){
            // Map click handling is now centralized in map.blade.php
            console.log("Admin Map Mode Initialized");
        });
    </script>
</x-layout-kcd>
