function SearchTitle( propos ) {
    const { keyword, count } = propos;

    if ( undefined === keyword || 2 > keyword.length ) {
        return null;
    }

    return (
        <>
            <span className="pt-24px d-block text-center ff-semibold text-dark-primary fs-short-2">{count } RÉSULTATS POUR { keyword }</span>
        </>
    );
}

export default SearchTitle;
