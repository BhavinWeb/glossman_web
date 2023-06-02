<div class="search-box">
    <div class="form-group">
        <input type="text" id="keyword" name="keyword" value="{{ request('keyword') }}"
            class="form-control" placeholder="{{ __('search_for_anything') }}...">
        <div class="icon">
            <x-svg.search width="21" height="20" />
        </div>
    </div>
</div>
<div class="sort-box">
    <p>{{ __('sort_by') }}:</p>
    <div class="selectbox">
        <select class="nice-select" name="sortBy">
            <option value="latest" @if (request('sortBy') == 'latest' || !request('sortBy')) selected @endif>{{ __('latest') }}
            </option>
            <option value="oldest" @if (request('sortBy') == 'oldest') selected @endif>{{ __('oldest') }}
            </option>
        </select>
    </div>
</div>
