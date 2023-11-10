<form method="post" action="{{ route('places.store') }}" enctype="multipart/form-data">
   @csrf
   @method('POST')
   <div class="form-group">
       <label for="upload">Archivo:</label>
       <input type="file" class="form-control" name="upload"/>
   </div>

   <div class="form-group">
        <label for="name">Name:</label>
        <textarea class="form-control" name="name" id="name" rows="4" required></textarea>
    </div>
    <div class="form-group">
        <label for="description">Descripcion:</label>
        <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
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
