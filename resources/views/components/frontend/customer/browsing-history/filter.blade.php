<div class="search-input-field">
    <div class="form-group">
        <input type="text" name="title" value="{{ request('title') ? request('title') : '' }}" placeholder="{{ __('search_for_anything') }}" class=" form-control">
        <div class="icon">
            <x-svg.search width="21" height="21" stroke="var(--bs-primary-500)" />
        </div>
    </div>
</div>
<div class="date-input-field">
    <div class="form-group">
        <input type="text" name="date" value="{{ request('date') ? request('date') : '' }}" placeholder="DD/MM/YYYY" onfocus="(this.type='date')" onblur="(this.type='text')" id="datepicker" class=" form-control">
        <div class="icon">
            <x-svg.calendar />
        </div>
    </div>
</div>
<button class="btn btn-primary">
    Search
</button>

