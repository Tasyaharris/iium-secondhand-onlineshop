
<section class="header border-bottom mt-0" id="header">

  <nav class="navbar bg-body-tertiary mt-0 " style="border: 1px solid #000; ">
    <div class="container-fluid" >
    
      <select class="form-select form-select-sm custome-select text-center" aria-label=".form-select-sm example" style="margin-left: 30px; width:180px" name="subactegory_id" id="category_id" >

        @foreach($subcategories as $subcategorie)
        @if(old('subcategory_id') == $subcategorie->id)
            <option value="{{ $subcategorie->id }}" selected>{{$subcategorie->name }}</option>
        @else
            <option value="{{ $subcategorie->id }}">{{$subcategorie->name }}</option>
        @endif
        @endforeach
      </select>

      <!--size-->
      <select class="form-select form-select-sm custome-select text-center" aria-label=".form-select-sm example" >
        <option selected >Size</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>

      
      <!--price-->
      <select class="form-select form-select-sm custome-select text-center" aria-label=".form-select-sm example" >
        <option selected >Price</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>

      <!--condition-->
      <select class="form-select form-select-sm custome-select text-center" aria-label=".form-select-sm example" id="contion_id" class="condition_id">
        <option selected >Condition</option>
        @foreach($conditions as $condition)
        @if(old('condition_id') == $condition->id)
            <option value="{{ $condition->id }}" selected>{{$condition->condition }}</option>
        @else
            <option value="{{ $condition->id }}">{{$condition->condition }}</option>
        @endif
        @endforeach
      </select>

           <!--filtering-->
           <select class="form-select form-select-sm custome-select text-center" aria-label=".form-select-sm example" style="margin-right: 30px;" >
            <option selected >Filtering</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>



    </div>
  </nav>

</section>
  
    