import SearchItem from './SearchItem';

function SearchResult( propos ) {
    const listItems = propos.results.map( ( object, index ) => <SearchItem
        item={object}
        key={index}
    /> );

    return (
        <>
            <div className="pt-24px">
                <ul className="d-flex mx-n12px flex-wrap">
                    {listItems}
                </ul>
            </div>
        </>
    );
}

export default SearchResult;
