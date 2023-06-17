        
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" placeholder="ProductName">
            <label for="name">category Name</label>
            </div>
    
            <button type="submit" class="btn btn-success">{{$btn_submit ?? 'SAVE'}}</button>
        </div>