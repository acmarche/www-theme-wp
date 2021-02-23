import CategoryChildren from './CategoryChildren';

function CollapseCategoryJf({
    categories,
    targetControlIdCollapse,
    setMarkerData
}) {
    const listChildren = Object.keys( categories.elements ).map( ( key ) => (
        <CategoryChildren
            key={key}
            name={categories.elements[key]}
            filtreKey={key}/>
    ) );

    return (
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
                        {categories.name}
                    </button>
                </h2>
            </div>
            <div
                id={targetControlIdCollapse}
                className="collapse"
                aria-labelledby="headingOne"
                data-parent="#accordionFiltres"
            >
                <div className="card-body p-0 pl-3">
                    <ul>
                        {listChildren}
                    </ul>
                </div>
            </div>
        </div>
    );
}

export default CollapseCategoryJf;
