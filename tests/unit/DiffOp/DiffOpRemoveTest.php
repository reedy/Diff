<?php

declare( strict_types = 1 );

namespace Diff\Tests\DiffOp;

use Diff\DiffOp\DiffOpAdd;
use Diff\DiffOp\DiffOpRemove;

/**
 * @covers \Diff\DiffOp\DiffOpRemove
 * @covers \Diff\DiffOp\AtomicDiffOp
 *
 * @group Diff
 * @group DiffOp
 *
 * @license BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class DiffOpRemoveTest extends DiffOpTest {

	/**
	 * @see DiffOpTest::getClass
	 *
	 * @since 0.1
	 *
	 * @return string
	 */
	public function getClass() {
		return '\Diff\DiffOp\DiffOpRemove';
	}

	/**
	 * @see DiffOpTest::constructorProvider
	 *
	 * @since 0.1
	 */
	public function constructorProvider() {
		return [
			[ true, 'foo' ],
			[ true, [] ],
			[ true, true ],
			[ true, 42 ],
			[ true, new DiffOpAdd( 'spam' ) ],
		];
	}

	/**
	 * @dataProvider instanceProvider
	 */
	public function testGetNewValue( DiffOpRemove $diffOp, array $constructorArgs ) {
		$this->assertEquals( $constructorArgs[0], $diffOp->getOldValue() );
	}

	/**
	 * @dataProvider instanceProvider
	 */
	public function testToArrayMore( DiffOpRemove $diffOp ) {
		$array = $diffOp->toArray();
		$this->assertArrayHasKey( 'oldvalue', $array );
	}

}
