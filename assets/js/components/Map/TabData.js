function TabData() {
    return (
        <>
            <ul className="nav nav-tabs" id="myTab" role="tablist">
                <li className="nav-item" role="presentation">
                    <a className="nav-link active" id="home-tab" data-toggle="tab" href="#carto"
                        role="tab" aria-controls="home" aria-selected="true">Carte</a>
                </li>
                <li className="nav-item" role="presentation">
                    <a className="nav-link" id="profile-tab" data-toggle="tab" href="#listing"
                        role="tab" aria-controls="profile" aria-selected="false">Liste</a>
                </li>
            </ul>
            <div className="tab-content" id="myTabContent">
                <div className="tab-pane fade show active" id="carto" role="tabpanel"
                    aria-labelledby="home-tab"><p>my home1</p>
                </div>
                <div className="tab-pane fade" id="listing" role="tabpanel"
                    aria-labelledby="profile-tab">...<p>my home2</p>
                </div>
            </div>
        </>
    );
}

export default TabData;
