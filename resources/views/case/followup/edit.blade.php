<div class="modal fade" id="exampleModalEditFollowUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('followUp.update',[$case->id]) }}" method="POST">{{ csrf_field() }}

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Follow up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          <div class="form-group">

         <label for="recipient-name" class="col-form-label">Assign To:             
            
            </label>
         
            @if($case->followUPExistsForCase())
            <select name="user_id" class="form-control" required>
              @foreach(\App\User::all() as $user)
                <option value="{{ $user->id}}" {{ $case->followUP->user_id ==   $user->id?'selected="selected"':''  }}>{{ ucfirst($user->name) }}
                </option>
            @endforeach

            </select> 
            @endif

        </div>
          <div class="form-group"> 
            <label for="message-text" class="col-form-label">Descriptions:</label>
        
            @if($case->followUPExistsForCase())<textarea name="description" class="form-control" id="message-text">{{ $case->followUP->description }}</textarea>@endif

           </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
  </form>
    </div>
  </div>
</div>
