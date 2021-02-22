import Axios from 'axios';

function CollapseCategory( {
    parentCategoryObject,
    categoriesToDisplay,
    setMarkerData,
    targetControlIdCollapse
} ) {
    const scrollToMapIfMobile = () => {
        console.log( window.innerWidth );
        if (window.innerWidth < 1000) {
            let mapPosition = document
                .querySelector( '.leaflet-container' )
                .getBoundingClientRect().bottom;
            console.log( mapPosition );
            window.scroll( {
                top: mapPosition,
                left: 0,
                behavior: 'smooth'
            } );
        }
    };
    const handleClick = ( event ) => {
        scrollToMapIfMobile();
        Axios.get( `https://new.marche.be/wp-json/ca/v1/map/${event.target.id}` )
            .then( ( res ) => {
                if (res.data.length !== 0) {
                    setMarkerData( res.data );
                } else {
                    return setMarkerData( null );
                }
            } )
            .catch( ( err ) => console.log( err.message ) );
    };

    return (
        <div className="accordion" id="accordionExample">
            <div className="card bg-white">
                <div className="card-header bg-white" id="headingOne">
                    <h2 className="mb-0">
                        <button
                            className={'btn btn-block text-left text-dark-primary shadow-none'}
                            type="button"
                            data-toggle="collapse"
                            data-target={`#${targetControlIdCollapse}`}
                            aria-expanded="false"
                            aria-controls={targetControlIdCollapse}
                        >
                            <i
                                style={{ fontSize: '1rem' }}
                                className={`${parentCategoryObject?.ParentCategoryIcon} pr-2`}
                            ></i>
                            {parentCategoryObject?.ParentCategoryName}
                        </button>
                    </h2>
                </div>

                <div
                    id={targetControlIdCollapse}
                    className="collapse"
                    aria-labelledby="headingOne"
                    data-parent="#accordionExample"
                >
                    <div className="card-body p-0 pl-3">
                        <ul>
                            {categoriesToDisplay
                                ?.filter(
                                    ( cat ) =>
                                        cat.parent_id == parentCategoryObject.ParentCategoryId
                                )
                                .map( ( object, i ) => {
                                    return (
                                        <li className="border-top" key={i}>
                                            <p
                                                id={object.id}
                                                style={{ cursor: 'pointer' }}
                                                onClick={( e ) => handleClick( e )}
                                                className="d-flex align-items-center p-16px text-dark-primary text-hover-primary transition-color icon_custom"
                                            >
                                                {object.name}
                                            </p>
                                        </li>
                                    );
                                } )}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default CollapseCategory;
