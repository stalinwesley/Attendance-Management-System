<?php 
$value = $value ?? '';
?>
<div class="form-group base-input">
  <input 
    class="input-field {{ $errors->has($name) ? 'invalid' : ''}}" 
  id="{{ isset($name) ? $name : ''}}" 
  type="{{ isset($type) ? $type : 'text' }}"
  aria-describedby="emailHelp" 
  placeholder="{{ isset($placeholder) ? $placeholder : 'Enter'}}" 
  name="{{ isset($name) ? $name : ''}}"
value="{{ old($name,$value)}}"
@isset($attributes)
    {{ $attributes }}
@endisset 
  >
  @error($name)
  <span class="text-danger"  >
    <strong>{{ $message }}</strong> 
  </span>
  @enderror
    </div>  
  