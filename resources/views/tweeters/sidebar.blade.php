<div class="panel panel-default">
  <div class="panel-heading"><b>Categories</b></div>
  <div class="panel-body">
        <ul>
        @forelse($tweeters as $tweet)
            <li> <a href="/tweeter/{{ $tweet->id }}">{{ $tweet->category_name }}</a></li>
        @empty
            <p>No Records Found</p>
        @endforelse
        </ul>
  </div>
</div>
 <div class="panel panel-default">
      <div class="panel-heading"> Add New Category</div>
      <div class="panel-body">
          <form method="POST"  role="form" class="form-group">
              {{ csrf_field() }} 
              <input type="text" name='category_name' class="form-control" />
              <br>
              <button class="btn btn-success"> Submit </button>
          </form>
      </div>
  </div>