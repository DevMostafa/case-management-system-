
<div class="modal fade" id="exampleModalServiceEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('service.update',[$case->id]) }}" method="POST">{{ csrf_field() }}
   <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Service name:             
            
            </label>
         
           @if($case->serviceGiveToThisId())
            <select name="service_name" class="form-control" required>
              @foreach(['first aid','pyschological treatment','rehabilitation'] as $service)
                <option value="{{ $service }}" {{$case->service->service_name == $service ? 'selected="selected"':''  }} >{{ ucfirst($service) }}</option>

              @endforeach

            </select> 
         @endif

        
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Descriptions:</label>
            <textarea name="description" class="form-control" id="message-text">@if($case->serviceGiveToThisId()){{ $case->service->description }}@endif</textarea>
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

