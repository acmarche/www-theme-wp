import Axios from 'axios';

function CollapseCategoryJf({
    name,
    categories,
    targetControlIdCollapse,
    setMarkerData
}) {
    console.log( categories, name );
    const scrollToMapIfMobile = () => {
        console.log( window.innerWidth );
        if ( 1000 > window.innerWidth ) {
            const mapPosition = document
                .querySelector( '.leaflet-container' )
                .getBoundingClientRect().bottom;
            console.log( mapPosition );
            window.scroll({
                top: mapPosition,
                left: 0,
                behavior: 'smooth'
            });
        }
    };
    const handleClick = ( event ) => {
        scrollToMapIfMobile();
        Axios.get( `https://new.marche.be/wp-json/ca/v1/map/${event.target.id}` )
            .then( ( res ) => {
                if ( 0 !== res.data.length ) {
                    setMarkerData( res.data );
                } else {
                    return setMarkerData( null );
                }
            })
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
                                className={`${categories.icone} pr-2`}
                            ></i>
                            {name}
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
                            <li className="border-top" key="1">
                                <p

                                    style={{ cursor: 'pointer' }}
                                    onClick={( e ) => handleClick( e )}
                                    className="d-flex align-items-center p-16px text-dark-primary text-hover-primary transition-color icon_custom"
                                >
                                                zzzz
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default CollapseCategoryJf;
