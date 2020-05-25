<div class="form-group base-input">
  <textarea 
    class="input-field {{ $errors->has($name) ? 'invalid' : ''}}" 
  id="{{$name}}" 
  aria-describedby="emailHelp" 
  placeholder="{{ isset($placeholder) ? $placeholder : 'Enter'}}" 
  name="{{$name}}"
  style="height: 100px"
@isset($attributes)
    {{ $attributes }}
@endisset>{{ old($name) ?: (isset($object) ? $object->name : '')}}</textarea>
  @error($name)  
  <div class="invalid-feedback"  >
    <strong>{{ $message }}</strong> 
  </div>
  @enderror
    </div>  
  