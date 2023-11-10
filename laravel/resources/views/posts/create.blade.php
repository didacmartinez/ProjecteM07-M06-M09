<form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
   @csrf
   @method('POST')
   <div class="form-group">
       <label for="upload">Archivo:</label>
       <input type="file" class="form-control" name="upload"/>
   </div>

   <div class="form-group">
        <label for="body">Body:</label>
        <textarea class="form-control" name="body" id="body" rows="4" required></textarea>
    </div>
    <div class="form-group">
        <label for="longitude">Longitude:</label>
        <input type="number" class="form-control" name="longitude" id="longitude" required>
    </div>

    <div class="form-group">
        <label for="latitude">Latitude:</label>
        <input type="number" class="form-control" name="latitude" id="latitude" required>
    </div>
   <button type="submit" class="btn btn-primary">Crear</button>
   <button type="reset" class="btn btn-secondary">Reset</button>
</form>