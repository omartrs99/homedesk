/**
 * External dependencies
 */
import classnames from "classnames"

export default function ogbTeamSave( props ) {

	const {
		attributes,
	} = props;
	const {
		blockId,
		alignment,
		mediaId,
		mediaUrl,
		mediaWidth,
		mediaHeight,
		imgSize,
		personName,
		personRole,
		personDesc,
	} = attributes;

	let htmlAttributes = {
		className: classnames( {
			'ogb-block': true,
			'ogb-team': true,
			[ `ogb-team-${blockId}` ]: true,
		} ),
	};

	let wrapperClass = {
		className: classnames( {
			'ogb-member-wrap': true,
			[ `ogb-team-align-${alignment}` ]: alignment,
		} ),
	};

	const imgAttribute = {
		width: mediaWidth,
		height: mediaHeight,
		src: mediaUrl != '' ? mediaUrl : 'none',
		className: 'attachment-'+imgSize+' size-'+imgSize
	};

	const memberImage = (
		<Fragment>
			<div className="ogb-member-image">
				{ ( mediaId && mediaUrl ) ?
					<img { ...imgAttribute}></img>
				:
					<img src={ utils.placeholder_img }></img>
				}
			</div>
		</Fragment>
	);

	return (
		<>
			<div { ...htmlAttributes }>
				<div { ...wrapperClass }>

					{ memberImage }

					<div className="ogb-member-content">

						{ personName && (
							<div className="ogb-member-name">
								{ personName }
							</div>
						) }

						{ personRole && (
							<div className="ogb-member-role">
								{ personRole }
							</div>
						) }

						{ personDesc && (
							<div className="ogb-member-description">
								{ personDesc }
							</div>
						) }

					</div>

				</div>
			</div>
		</>
	)
}